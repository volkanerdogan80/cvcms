<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col"><?= cve_admin_lang('Analytics', 'referral') ?></th>
        <th scope="col"><?= cve_admin_lang('Analytics', 'visitor') ?></th>
        <th scope="col"><?= cve_admin_lang('Analytics', 'page_view') ?></th>
        <th scope="col"><?= cve_admin_lang('Analytics', 'sg_ot') ?></th> <!-- Sayfa Görüntüleme / Oturum -->
    </tr>
    </thead>
    <tbody>
    <?php if($referral != null): ?>
    <?php foreach ($referral as $key => $value): ?>
        <tr>
            <td><?= $value[0]; ?></td>
            <td><?= $value[1]; ?></td>
            <td><?= $value[2]; ?></td>
            <td><?= round($value[3], 2); ?></td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td>
                <div class="text-info mt-2"><i class="far fa-lightbulb"></i> <?= cve_admin_lang('Analytics', 'no_data') ?></div>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>