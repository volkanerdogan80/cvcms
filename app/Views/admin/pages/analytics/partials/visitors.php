<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col"><?= cve_admin_lang('Analytics', 'date') ?></th>
        <th scope="col"><?= cve_admin_lang('Analytics', 'user') ?></th>
        <th scope="col"><?= cve_admin_lang('Analytics', 'session') ?></th>
        <th scope="col"><?= cve_admin_lang('Analytics', 'page_view') ?></th>
        <th scope="col"><?= cve_admin_lang('Analytics', 'pw_vs') ?></th> <!-- Sayfa Görüntüleme / Ziyaretçi -->
        <th scope="col"><?= cve_admin_lang('Analytics', 'instant_view') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($visitors as $key => $value): ?>
        <?php
        $year = substr($value[0], 0, 4);
        $month = substr($value[0], 4, 2);
        $day = substr($value[0], 6, 2);
        ?>
        <tr>
            <td><?php echo $day . '-' . $month . '-' . $year; ?></td>
            <td><?= $value[1]; ?></td>
            <td><?= $value[2]; ?></td>
            <td><?= $value[3]; ?></td>
            <td><?= round($value[4], 2); ?></td>
            <td>%<?= round($value[5], 2); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>