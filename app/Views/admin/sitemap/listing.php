<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($list as $key => $value): ?>
        <?php for ($i=0; $i < $value; $i++): ?>
            <sitemap>
                <loc><?= base_url(route_to('sitemap.generate', $key, $i+1)) ?></loc>
            </sitemap>
        <?php endfor; ?>
    <?php endforeach; ?>
</sitemapindex>