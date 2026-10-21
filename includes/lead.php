<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

function clean_line(string $value, int $max): string
{
    $value = trim(preg_replace('/\s+/u', ' ', strip_tags($value)) ?? '');
    return fv_cut($value, $max);
}

function clean_text(string $value, int $max): string
{
    $value = trim(strip_tags($value));
    $value = preg_replace("/\r\n?/", "\n", $value) ?? $value;
    return fv_cut($value, $max);
}

function process_lead(string $intent): array
{
    $old = [
        'name' => clean_line((string) ($_POST['name'] ?? ''), 80),
        'email' => clean_line((string) ($_POST['email'] ?? ''), 120),
        'phone' => clean_line((string) ($_POST['phone'] ?? ''), 40),
        'company' => clean_line((string) ($_POST['company'] ?? ''), 120),
        'country' => clean_line((string) ($_POST['country'] ?? ''), 80),
        'team' => clean_line((string) ($_POST['team'] ?? ''), 20),
        'interest' => clean_line((string) ($_POST['interest'] ?? ''), 40),
        'message' => clean_text((string) ($_POST['message'] ?? ''), 2000),
        'privacy' => (string) ($_POST['privacy'] ?? ''),
    ];

    $honeypot = trim((string) ($_POST['website'] ?? ''));
    if ($honeypot !== '') {
        return ['ok' => true, 'old' => [], 'errors' => [], 'alert' => null];
    }

    $token = (string) ($_POST['csrf'] ?? '');
    $sessionToken = (string) ($_SESSION['csrf'] ?? '');
    if ($sessionToken === '' || !hash_equals($sessionToken, $token)) {
        return ['ok' => false, 'old' => $old, 'errors' => [], 'alert' => t('form.error_csrf')];
    }

    $now = time();
    $hits = array_values(array_filter(
        $_SESSION['lead_times'] ?? [],
        static fn ($time) => is_int($time) && ($now - $time) < 3600
    ));
    if (count($hits) >= 8 || ($hits !== [] && ($now - max($hits)) < 12)) {
        return ['ok' => false, 'old' => $old, 'errors' => [], 'alert' => t('form.error_rate')];
    }

    $errors = [];
    if (fv_lower($old['name']) === '' || (function_exists('mb_strlen') ? mb_strlen($old['name']) : strlen($old['name'])) < 2) {
        $errors['name'] = t('form.error_required');
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = t('form.error_email');
    }
    if ((function_exists('mb_strlen') ? mb_strlen($old['company']) : strlen($old['company'])) < 2) {
        $errors['company'] = t('form.error_required');
    }
    if ($old['phone'] !== '' && preg_match_all('/\d/', $old['phone']) < 6) {
        $errors['phone'] = t('form.error_phone');
    }
    if (!in_array($old['team'], FV_TEAMS, true)) {
        $errors['team'] = t('form.error_required');
    }
    $interests = array_merge(array_keys(FV_PRODUCTS), ['all']);
    if (!in_array($old['interest'], $interests, true)) {
        $errors['interest'] = t('form.error_required');
    }
    if ($old['privacy'] !== '1') {
        $errors['privacy'] = t('form.error_privacy');
    }

    if ($errors !== []) {
        return ['ok' => false, 'old' => $old, 'errors' => $errors, 'alert' => t('form.error_generic')];
    }

    $row = [
        'at' => gmdate('c'),
        'intent' => $intent,
        'lang' => $GLOBALS['locale'] ?? '',
        'ip' => (string) ($_SERVER['REMOTE_ADDR'] ?? ''),
        'name' => $old['name'],
        'email' => $old['email'],
        'phone' => $old['phone'],
        'company' => $old['company'],
        'country' => $old['country'],
        'team' => $old['team'],
        'interest' => $old['interest'],
        'message' => $old['message'],
    ];

    $dir = FV_ROOT . '/storage';
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
        return ['ok' => false, 'old' => $old, 'errors' => [], 'alert' => t('form.error_save')];
    }
    $handle = fopen($dir . '/leads.jsonl', 'ab');
    if ($handle === false) {
        return ['ok' => false, 'old' => $old, 'errors' => [], 'alert' => t('form.error_save')];
    }
    $written = false;
    if (flock($handle, LOCK_EX)) {
        $written = fwrite($handle, json_encode($row, JSON_UNESCAPED_UNICODE) . "\n") !== false;
        flock($handle, LOCK_UN);
    }
    fclose($handle);
    if (!$written) {
        return ['ok' => false, 'old' => $old, 'errors' => [], 'alert' => t('form.error_save')];
    }

    $_SESSION['lead_times'] = array_merge($hits, [$now]);
    return ['ok' => true, 'old' => [], 'errors' => [], 'alert' => null];
}
