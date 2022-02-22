<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col"> <?= cve_admin_lang('Analytics', 'operating') ?></th>
        <th scope="col"> <?= cve_admin_lang('Analytics', 'visitor') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if($operating != null): ?>
    <?php foreach ($operating as $key => $value): ?>
        <tr>
            <td><?= $value[0]; ?></td>
            <td><?= $value[1]; ?></td>
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