<?php cve_theme_include('inc/head'); ?>
<?php cve_theme_include('inc/header'); ?>
		<section class="home">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-12 col-xs-12">
                        <?php cve_theme_include('home/headline'); ?>
                        <?php cve_theme_include('home/carousel'); ?>
                        <?php cve_theme_include('home/latest-news'); ?>

						<div class="banner">
							<a href="#">
								<img src="<?= cve_theme_public(''); ?>/images/ads.png" alt="Sample Article">
							</a>
						</div>
						<div class="line transparent little"></div>

                        <?php cve_theme_include('home/another-news'); ?>
					</div>
                    <?php cve_theme_include('home/sidebar'); ?>
				</div>
			</div>
		</section>
    <?php cve_theme_include('home/best-of-the-week'); ?>
    <?php cve_theme_include('inc/footer'); ?>
