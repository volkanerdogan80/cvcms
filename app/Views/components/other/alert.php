<?php if(session()->has('error')){ ?>
    <?php if (is_array(session()->error)){ ?>
        <?php foreach (session()->error as $key => $value){ ?>
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><?= $value; ?></p>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><?= session()->error; ?></p>
        </div>
    <?php } ?>
<?php } ?>

<?php if(session()->has('success')){ ?>
    <?php if (is_array(session()->success)){ ?>
        <?php foreach (session()->success as $key => $value){ ?>
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><?= $value; ?></p>
            </div>
        <?php } ?>
    <?php }else{ ?>
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><?= session()->success; ?></p>
        </div>
    <?php } ?>
<?php } ?>