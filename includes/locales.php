<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

/**
 * Idiomas del sitio. "html" es el atributo lang. "dir" es ltr o rtl.
 * Solo aparece en el selector si existe lang/{code}.json.
 */
const LOCALES = [
    'es' => ['native' => 'Español', 'name' => 'Spanish', 'html' => 'es', 'dir' => 'ltr', 'og' => 'es_ES'],
    'en' => ['native' => 'English', 'name' => 'English', 'html' => 'en', 'dir' => 'ltr', 'og' => 'en_US'],
    'pt' => ['native' => 'Português', 'name' => 'Portuguese', 'html' => 'pt', 'dir' => 'ltr', 'og' => 'pt_BR'],
    'fr' => ['native' => 'Français', 'name' => 'French', 'html' => 'fr', 'dir' => 'ltr', 'og' => 'fr_FR'],
    'de' => ['native' => 'Deutsch', 'name' => 'German', 'html' => 'de', 'dir' => 'ltr', 'og' => 'de_DE'],
    'it' => ['native' => 'Italiano', 'name' => 'Italian', 'html' => 'it', 'dir' => 'ltr', 'og' => 'it_IT'],
    'nl' => ['native' => 'Nederlands', 'name' => 'Dutch', 'html' => 'nl', 'dir' => 'ltr', 'og' => 'nl_NL'],
    'pl' => ['native' => 'Polski', 'name' => 'Polish', 'html' => 'pl', 'dir' => 'ltr', 'og' => 'pl_PL'],
    'tr' => ['native' => 'Türkçe', 'name' => 'Turkish', 'html' => 'tr', 'dir' => 'ltr', 'og' => 'tr_TR'],
    'ru' => ['native' => 'Русский', 'name' => 'Russian', 'html' => 'ru', 'dir' => 'ltr', 'og' => 'ru_RU'],
    'ar' => ['native' => 'العربية', 'name' => 'Arabic', 'html' => 'ar', 'dir' => 'rtl', 'og' => 'ar_AR'],
    'hi' => ['native' => 'हिन्दी', 'name' => 'Hindi', 'html' => 'hi', 'dir' => 'ltr', 'og' => 'hi_IN'],
    'zh' => ['native' => '中文', 'name' => 'Chinese', 'html' => 'zh-Hans', 'dir' => 'ltr', 'og' => 'zh_CN'],
    'ja' => ['native' => '日本語', 'name' => 'Japanese', 'html' => 'ja', 'dir' => 'ltr', 'og' => 'ja_JP'],
    'ko' => ['native' => '한국어', 'name' => 'Korean', 'html' => 'ko', 'dir' => 'ltr', 'og' => 'ko_KR'],
    'id' => ['native' => 'Bahasa Indonesia', 'name' => 'Indonesian', 'html' => 'id', 'dir' => 'ltr', 'og' => 'id_ID'],
];
