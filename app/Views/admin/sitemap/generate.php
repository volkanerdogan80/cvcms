<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    <?php $modules = config('sitemap')->modules; ?>
    <?php foreach ($contents as $content): ?>
        <url>
            <loc><?= base_url($defaultLocale . '/' . $content->getSlug()); ?></loc>
            <lastmod><?= $content->getUpdatedAt() ?></lastmod>
            <changefreq><?= $modules[$content->getModule()]['changefreq']; ?></changefreq>
            <priority><?= $modules[$content->getModule()]['priority']; ?></priority>
            <?php foreach (cve_language() as $lang): ?>
            <xhtml:link rel="alternate" hreflang="<?= $lang->getCode() ?>" href="<?= base_url($lang->getCode() . '/' . $content->getSlug()); ?>"/>
            <?php endforeach; ?>
        </url>
    <?php endforeach; ?>
</urlset>