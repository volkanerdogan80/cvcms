<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col"><?= cve_admin_lang_path('Analytics', 'page') ?></th>
        <th scope="col"><?= cve_admin_lang_path('Analytics', 'visitor') ?></th>
        <th scope="col"><?= cve_admin_lang_path('Analytics', 'page_view') ?></th>
        <th scope="col"><?= cve_admin_lang_path('Analytics', 'uniq_page_view') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if($topContent != null): ?>
    <?php foreach ($topContent as $key => $value): ?>
        <tr>
            <td><?= $value[0]; ?></td>
            <td><?= $value[1]; ?></td>
            <td><?= $value[2]; ?></td>
            <td><?= $value[3]; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td>
                <div class="text-info mt-2"><i class="far fa-lightbulb"></i> <?= cve_admin_lang_path('Analytics', 'no_data') ?></div>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>