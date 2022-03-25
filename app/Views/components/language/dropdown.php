<div class="cve-lang-dropdown-nav">
    <ul>
        <li>
            <i class="cve-lang-dropdown-flag"
               style="background: url('<?= cve_language(true)->getFlag(); ?>');background-size: cover;background-position: center center;">
            </i>
            <b><?= cve_language(true)->getTitle(); ?></b>
            <i class="fa fa-angle-down" aria-hidden="true"></i>
            <div class="triangle"></div>
            <ul>
                <?php foreach (cve_language() as $lang): ?>
                    <li>
                        <a href="<?= $lang->getChange(); ?>"
                           class="uk-link-reset">
                            <i class="cve-lang-dropdown-flag"
                               style="background: url('<?= $lang->getFlag(); ?>');background-size: cover;background-position: center center;">
                            </i>
                            <span class="active"><?= $lang->getTitle(); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
    </ul>
</div>
