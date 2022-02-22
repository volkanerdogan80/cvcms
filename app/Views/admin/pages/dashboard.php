<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang('Sidebar', 'dashboard'); ?></h1>
            </div>
            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4><?= cve_admin_lang('Dashboard', 'blog_content'); ?></h4>
                                </div>
                                <div class="card-body">
                                    <?= $count['blog'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-comment"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4><?= cve_admin_lang('Dashboard', 'comments'); ?></h4>
                                </div>
                                <div class="card-body">
                                    <?= $count['comment']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4><?= cve_admin_lang('Dashboard', 'users'); ?></h4>
                                </div>
                                <div class="card-body">
                                    <?= $count['user']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-circle"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Online</h4>
                                </div>
                                <div class="card-body analytics-realtime-visitors">
                                    0
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang('Dashboard', 'last_register_user') ?></h4>
                                <div class="card-header-action">
                                    <a href="<?= base_url(route_to('admin_user_listing', null)); ?>" class="btn btn-primary"><?= cve_admin_lang('Buttons', 'view_all'); ?></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row pb-2">
                                    <?php foreach ($users as $user): ?>
                                        <div class="col-6 col-sm-1 col-lg-1 mb-4 mb-md-0">
                                            <div class="avatar-item mb-0">
                                                <img alt="image" src="<?= base_url('public/admin/img/avatar/avatar-3.png') ?>"
                                                     class="img-fluid"
                                                     data-toggle="tooltip"
                                                     title="<?= $user->getFullName(); ?>">
                                                <div class="avatar-badge" title=" <?= $user->withGroup()->getTitle(); ?>" data-toggle="tooltip"><i class="fas fa-wrench"></i></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang('Dashboard', 'last_blog_content'); ?></h4>
                                <div class="card-header-action">
                                    <a href="<?= base_url(route_to('admin_blog_listing', null)); ?>" class="btn btn-primary"><?= cve_admin_lang('Buttons', 'view_all'); ?></a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Başlık</th>
                                            <th>Yazar</th>
                                            <th>Oluşturulma Tarihi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($blogs as $blog): ?>
                                            <tr>
                                                <td>
                                                    <?= $blog->getTitle(); ?>
                                                    <div class="table-links">
                                                        <a href="<?= base_url(route_to('admin_blog_edit', $blog->id)); ?>">Düzenle</a>
                                                        <div class="bullet"></div>
                                                        <a href="#">Görüntüle</a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= $blog->withUser()->getFullName(); ?>
                                                </td>
                                                <td>
                                                    <?= $blog->getCreatedAt(); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4><?= cve_admin_lang('Dashboard', 'recent_activities') ?></h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn btn-primary"><?= cve_admin_lang('Buttons', 'view_all'); ?></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="<?= base_url('public/admin/img/avatar/avatar-1.png'); ?>" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary">Şimdi</div>
                                            <div class="media-title">Volkan Erdoğan</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="<?= base_url('public/admin/img/avatar/avatar-2.png'); ?>" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">12dk önce</div>
                                            <div class="media-title">Volkan Erdoğan</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="<?= base_url('public/admin/img/avatar/avatar-3.png'); ?>" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">21dk önce</div>
                                            <div class="media-title">Volkan Erdoğan</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="<?= base_url('public/admin/img/avatar/avatar-4.png'); ?>" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">34dk önce</div>
                                            <div class="media-title">Volkan Erdoğan</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>

<?php $this->section('script'); ?>

<?= script_tag(PUBLIC_ADMIN_JS_PATH . 'chart.min.js') ?>
    <script>
        var statistics_chart = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(statistics_chart, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                    label: 'Statistics',
                    data: [640, 387, 530, 302, 430, 270, 488],
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 2
                        }
                    }]
                },
            }
        });
    </script>
<?= script_tag('public/admin/js/countries.js') ?>
<?= script_tag('public/admin/js/jquery.vmap.min.js') ?>
<?= script_tag('public/admin/js/jquery.vmap.world.js') ?>
<?= script_tag('public/admin/js/analytics.js') ?>
<?php $this->endSection(); ?>
