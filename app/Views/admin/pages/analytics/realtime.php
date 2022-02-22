<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('style'); ?>
<?= link_tag('public/admin/css/jqvmap.min.css') ?>
<?php $this->endSection(); ?>


<?php $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= cve_admin_lang('Analytics', 'instant_visitors') ?></h1>
            <div class="section-header-breadcrumb">
                <a href="<?= base_url(route_to('admin_analytics_metrics')); ?>" class="btn btn-primary" style="margin-right: 7px">
                    <i class="fas fa-history"></i> <?= cve_admin_lang('Buttons', 'visitor_history') ?>
                </a>
            </div>
        </div>

        <?= $this->include('admin/layout/partials/errors'); ?>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4><?= cve_admin_lang('Analytics', 'visitors') ?></h4>
                        </div>
                        <div class="card-body">
                            <div id="visitorMap" data-height="300"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-3">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="analytics-realtime-visitors">0</h4>
                            <div class="card-description" data-height="285" style="height: 285px;"><?= cve_admin_lang('Analytics', 'visitor_number') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <ul class="list-group analytics-realtime-data">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<?= script_tag('public/admin/js/countries.js') ?>
<?= script_tag('public/admin/js/jquery.sparkline.min.js') ?>
<?= script_tag('public/admin/js/chart.min.js') ?>
<?= script_tag('public/admin/js/jquery.vmap.min.js') ?>
<?= script_tag('public/admin/js/jquery.vmap.world.js') ?>
<?= script_tag('public/admin/js/analytics.js') ?>
<?= script_tag('public/admin/js/statistic.js') ?>
<script>
    let admin_realtime_visitors = '<?= base_url(route_to('admin_realtime_visitors')); ?>'
</script>
<?php $this->endSection(); ?>
