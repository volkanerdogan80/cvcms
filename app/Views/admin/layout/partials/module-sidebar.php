<?php foreach (cve_module_list() as $module): ?>

    <?php $config = module_config($module, 'menu'); ?>

    <?php if (isset($config->sidebar) && !is_null($config->sidebar) && count($config->sidebar) > 0): ?>
        <?php foreach ($config->sidebar as $item): ?>
            <?php if (isset($item['child']) && count($item['child']) > 0): ?>
                <li class="nav-item dropdown" id="<?= $module . '_menu'; ?>">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-text-height"></i>
                        <span>
                        <?= cve_admin_lang($module, 'module') ?>
                    </span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($item['child'] as $child): ?>
                            <li>
                                <a class="nav-link" href="<?= base_url(route_to($child['router'], null)); ?>">
                                    <?= cve_admin_lang($module, $child['title']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php else: ?>
                <li>
                    <a class="nav-link" href="<?= base_url(route_to($item['router'], null)); ?>">
                        <i class="fas fa-text-height"></i>
                        <span> <?= cve_admin_lang($module, $item['title']); ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>

    <?php endif; ?>
<?php endforeach; ?>
