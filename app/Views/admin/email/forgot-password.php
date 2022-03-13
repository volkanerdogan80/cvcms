<?php $this->extend(PANEL_FOLDER . '/email/main'); ?>

<?php $this->section('content'); ?>

<table role="presentation" class="main">
    <tr>
        <td class="wrapper">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <p><?= cve_admin_lang('EmailTemplate', 'greeting') ?> <?= $user->getFullName(); ?>,</p>
                        <p><?= cve_admin_lang('EmailTemplate', 'password_forgot_content') ?></p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                            <tr>
                                <td align="left">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <?php if (cve_request_type_api()): ?>
                                                    <a href="javascript:void(0)">
                                                        <?= $user->getVerifyCode(); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= base_url(route_to('admin_reset_password', $user->getVerifyToken())); ?>" target="_blank">
                                                        <?= cve_admin_lang('Auth', 'reset_password') ?>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p><?= cve_admin_lang('EmailTemplate', 'alt_content') ?></p>
                        <p><?= cve_admin_lang('EmailTemplate', 'thanks') ?></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php $this->endSection(); ?>
