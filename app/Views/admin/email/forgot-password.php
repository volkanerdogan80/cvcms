<?php $this->extend(PANEL_FOLDER . '/email/main'); ?>

<?php $this->section('content'); ?>

<table role="presentation" class="main">
    <tr>
        <td class="wrapper">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p><?= cve_admin_lang_path('EmailTemplate', 'greeting') ?> <?= $user->getFullName(); ?>,</p>
                        <p><?= cve_admin_lang_path('EmailTemplate', 'password_forgot_content') ?></p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                            <tr>
                                <td align="left">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url(route_to('admin_forgot_verify', $user->getVerifyToken())); ?>" target="_blank">
                                                    <?= cve_admin_lang_path('Auth', 'reset_password') ?>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p><?= cve_admin_lang_path('EmailTemplate', 'alt_content') ?></p>
                        <p><?= cve_admin_lang_path('EmailTemplate', 'thanks') ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php $this->endSection(); ?>
