<?php $this->extend(PANEL_FOLDER . '/email/main'); ?>

<?php $this->section('content'); ?>

<table role="presentation" class="main">
    <tr>
        <td class="wrapper">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p><?= cve_admin_lang('EmailTemplate','newsletter_subscribe_success_hello') ?> <?= $user->name; ?></p>
                        <p><?= cve_admin_lang('EmailTemplate','newsletter_subscribe_success_content') ?></p>
                        <p><?= cve_admin_lang('EmailTemplate','newsletter_subscribe_success_alt_content') ?></p>
                        <p>
                            <a class="btn btn-primary" href="<?= base_url(route_to('newsletter_unsubscribe', $user->token)) ?>">
                                <?= cve_admin_lang('EmailTemplate', 'newsletter_unsubscribe_button'); ?>
                            </a>
                        </p>
                        <p><?= cve_admin_lang('EmailTemplate','newsletter_subscribe_success_thanks') ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php $this->endSection(); ?>
