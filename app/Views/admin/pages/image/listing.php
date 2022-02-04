<?php $this->extend(PANEL_FOLDER . '/layout/main'); ?>

<?php $this->section('content'); ?>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1><?= cve_admin_lang_path('Sidebar', 'images') ?></h1>
            </div>

            <?= $this->include(PANEL_FOLDER . '/layout/partials/errors'); ?>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url(route_to('admin_image_upload')); ?>" id="image-listing-dropzone" class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= current_url(); ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="per_page" class="form-control selectric">
                                            <option value=""><?= cve_admin_lang_path('Inputs', 'per_page') ?></option>
                                            <?php foreach (config('system')->perPageList as $per): ?>
                                                <option value="<?= $per ?>"><?= $per ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input value="<?= $dateFilter ?>" name="dateFilter" placeholder="<?= cve_admin_lang_path('Inputs', 'date_filter') ?>" type="text" class="form-control daterange-cus">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-light date_filter_clear"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input value="<?= $search ?>" name="search" type="text" class="form-control" placeholder="<?= cve_admin_lang_path('Inputs', 'search') ?>...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="gallery gallery-md" id="image-listing">
                            <?php foreach ($images as $image): ?>
                                <div data-id="<?= $image->id; ?>" class="gallery-item"
                                     data-image="<?= $image->getUrl(); ?>"
                                     data-title="<?= $image->getName(); ?>"
                                >
                                    <button class="btn btn-danger btn-sm m-2 image-delete"
                                            data-id="<?= $image->id; ?>"
                                            data-url="<?= base_url(route_to('admin_image_delete')) ?>"
                                            style="float: right; z-index: 10000"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <?= $pager->links('default', 'cms_pager'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $this->endSection(); ?>


<?php $this->section('script'); ?>

<script>
    $(document).ready(function (){
        Dropzone.autoDiscover = true;
        let test = new Dropzone("#image-listing-dropzone");
        test.on("complete", function(file) {
            let image = JSON.parse(file.xhr.response);
            if(!image.status){
                iziToast.error({message: image.message.file, position: 'topRight'});
            }else{
                $('#image-listing').prepend('<div data-id = "'+image.id+'"'+
                    'class="gallery-item" ' +
                    'data-image="'+image.src+'" ' +
                    'data-title="Image 1" href="'+image.src+'" ' +
                    'title="Image 1" style="background-image: url(&quot;'+image.src+'&quot;);">\n' +
                    '<button class="btn btn-danger btn-sm m-2 image-delete" ' +
                    'data-id = "'+image.id+'"'+
                    'data-url = "<?= base_url(route_to("admin_image_delete")) ?>"'+
                    'style="float: right; z-index: 10000">' +
                    '<i class="fas fa-trash"></i>' +
                    '</button>\n' +
                    '</div>')
            }
        });
    })
</script>

<script>
    $("input[name=dateFilter]").val('<?= $dateFilter?>');
    $("select[name=per_page]").val('<?= $perPage?>');
</script>

<script>
    $(document).on('click', '.image-delete', function (){
        $('.chocolat-wrapper').remove();
        let id = $(this).data('id');
        let url = $(this).data('url');

        cve_request.post(url, {id: id}, function (response){
            if(response.status){
                $('div[data-id='+id+']').remove();
            }
        })
        return false;
    });
</script>

<?php $this->endSection(); ?>

