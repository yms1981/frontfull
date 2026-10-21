<?php
declare(strict_types=1);

if (!defined('FV_APP')) {
    http_response_code(403);
    exit;
}

function render_lead_form(string $intent): void
{
    global $formOk, $formAlert, $fieldErrors, $locale;

    if (!empty($formOk)) {
        echo '<div class="form-success" role="status">';
        echo '<span class="stat-ico">' . icon('check') . '</span>';
        echo '<h2>' . e(t('form.sent_title')) . '</h2>';
        echo '<p>' . e(t('form.sent_text')) . '</p>';
        echo '</div>';
        return;
    }

    $interest = old_value('interest');
    if ($interest === '' && isset($_GET['producto']) && isset(FV_PRODUCTS[(string) $_GET['producto']])) {
        $interest = (string) $_GET['producto'];
    }
    $team = old_value('team');
    ?>
    <?php if (!empty($formAlert)): ?>
      <p class="form-alert" role="alert"><?= e($formAlert) ?></p>
    <?php endif; ?>
    <form class="lead-form" method="post" action="<?= e(url_to($locale, $intent)) ?>">
      <input type="hidden" name="csrf" value="<?= e((string) ($_SESSION['csrf'] ?? '')) ?>">
      <div class="hp" aria-hidden="true">
        <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off" value=""></label>
      </div>
      <div class="form-grid">
        <label class="field">
          <span><?= e(t('form.name')) ?></span>
          <input name="name" required maxlength="80" autocomplete="name" value="<?= e(old_value('name')) ?>" placeholder="<?= e(t('form.ph_name')) ?>" <?= isset($fieldErrors['name']) ? 'aria-invalid="true"' : '' ?>>
          <?= field_error('name') ?>
        </label>
        <label class="field">
          <span><?= e(t('form.email')) ?></span>
          <input name="email" type="email" required maxlength="120" autocomplete="email" value="<?= e(old_value('email')) ?>" placeholder="<?= e(t('form.ph_email')) ?>" <?= isset($fieldErrors['email']) ? 'aria-invalid="true"' : '' ?>>
          <?= field_error('email') ?>
        </label>
        <label class="field">
          <span><?= e(t('form.phone')) ?> <em><?= e(t('form.optional')) ?></em></span>
          <input name="phone" type="tel" maxlength="40" autocomplete="tel" value="<?= e(old_value('phone')) ?>" placeholder="<?= e(t('form.ph_phone')) ?>" <?= isset($fieldErrors['phone']) ? 'aria-invalid="true"' : '' ?>>
          <?= field_error('phone') ?>
        </label>
        <label class="field">
          <span><?= e(t('form.company')) ?></span>
          <input name="company" required maxlength="120" autocomplete="organization" value="<?= e(old_value('company')) ?>" placeholder="<?= e(t('form.ph_company')) ?>" <?= isset($fieldErrors['company']) ? 'aria-invalid="true"' : '' ?>>
          <?= field_error('company') ?>
        </label>
        <label class="field">
          <span><?= e(t('form.country')) ?> <em><?= e(t('form.optional')) ?></em></span>
          <input name="country" maxlength="80" autocomplete="country-name" value="<?= e(old_value('country')) ?>" placeholder="<?= e(t('form.ph_country')) ?>">
        </label>
        <label class="field">
          <span><?= e(t('form.team')) ?></span>
          <select name="team" required <?= isset($fieldErrors['team']) ? 'aria-invalid="true"' : '' ?>>
            <option value="" disabled <?= $team === '' ? 'selected' : '' ?>><?= e(t('form.choose')) ?></option>
            <?php foreach (FV_TEAMS as $option): ?>
              <option value="<?= e($option) ?>" <?= $team === $option ? 'selected' : '' ?>><?= e(t('form.team_options.' . $option)) ?></option>
            <?php endforeach; ?>
          </select>
          <?= field_error('team') ?>
        </label>
        <label class="field full">
          <span><?= e(t('form.interest')) ?></span>
          <select name="interest" required <?= isset($fieldErrors['interest']) ? 'aria-invalid="true"' : '' ?>>
            <option value="" disabled <?= $interest === '' ? 'selected' : '' ?>><?= e(t('form.choose')) ?></option>
            <option value="all" <?= $interest === 'all' ? 'selected' : '' ?>><?= e(t('form.interest_all')) ?></option>
            <?php foreach (FV_PRODUCTS as $id => $product): ?>
              <option value="<?= e($id) ?>" <?= $interest === $id ? 'selected' : '' ?>><?= e($product['name']) ?></option>
            <?php endforeach; ?>
          </select>
          <?= field_error('interest') ?>
        </label>
        <label class="field full">
          <span><?= e(t('form.message')) ?> <em><?= e(t('form.optional')) ?></em></span>
          <textarea name="message" rows="4" maxlength="2000" placeholder="<?= e(t('form.ph_message')) ?>"><?= e(old_value('message')) ?></textarea>
        </label>
        <label class="check full">
          <input type="checkbox" name="privacy" value="1" required <?= old_value('privacy') === '1' ? 'checked' : '' ?>>
          <span><?= e(t('form.privacy_before')) ?> <a href="<?= e(url_to($locale, 'privacy')) ?>"><?= e(t('footer.privacy')) ?></a><?= e(t('form.privacy_after')) ?></span>
        </label>
        <?= field_error('privacy') !== '' ? '<div class="full">' . field_error('privacy') . '</div>' : '' ?>
        <div class="full form-actions">
          <button class="btn btn-primary" type="submit"><span><?= e(t('form.submit')) ?></span><?= icon('arrow') ?></button>
        </div>
      </div>
    </form>
    <?php
}
