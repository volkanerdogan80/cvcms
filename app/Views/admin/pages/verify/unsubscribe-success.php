<?php $this->extend('admin/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Başarılı</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state">
                            <div class="empty-state-icon bg-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <h2>Abonelikten Çıkıldı</h2>
                            <p>Eposta aboneliği başarılı bir şekilde iptal edildi. Gittiğin için çok üzgünüz :( Umarız kısa sürede yeniden aramıza katılırsın.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>