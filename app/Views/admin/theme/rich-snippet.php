<?php if (is_blog() || is_page() || is_service()): ?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?= cve_link(); ?>"
            },
            "headline": "<?= cve_title(); ?>",
            "image": [
                <?php if (cve_post_gallery()): ?>
                    "<?= cve_thumbnail(); ?>",
                    <?php
                $schema_gallery_list = [];
                foreach (cve_post_gallery() as $gallery):
                    ?>
                    <?php $schema_gallery_list[] = sprintf('"%s"', $gallery->getUrl()); ?>
                <?php endforeach; ?>
                <?= implode(',', $schema_gallery_list); ?>
                <?php else: ?>
                        "<?= cve_thumbnail(); ?>"
                <?php endif; ?>
            ],
            "datePublished": "<?= cve_post_created_at(); ?>",
            "dateModified": "<?= cve_post_updated_at(); ?>",
            "author": {
                "@type": "Person",
                "name": "<?= cve_post_author(['key' => 'fullname']); ?>"
            },
            "publisher": {
                "@type": "Organization",
                "name": "<?= cve_site_title(); ?>",
                "logo": {
                    "@type": "ImageObject",
                    "url": "<?= cve_site_header_logo(); ?>"
                }
            }
        }
    </script>
<?php endif; ?>
