<div id="fly-whatsapp-button"></div>

<script type="text/javascript">
    $('#fly-whatsapp-button').flyWhatsappButton({
        phone: '<?= cve_component_setting('whatsappPhone') ?>',
        popupMessage: '<?= cve_component_setting('whatsappPopupMessage') ?>',
        message: "<?= cve_component_setting('whatsappMessage') ?>",
        showPopup: true,
        position: "<?= cve_component_setting('whatsappPosition') ?>",
        linkButton: false,
        showOnIE: false,
        headerTitle: '<?= cve_component_setting('whatsappTitle') ?>',
        headerColor: '#25d366',
        backgroundColor: '#25d366',
        buttonImage: '<img src="<?= cve_image_url(cve_component_setting('whatsappImage')); ?>" />'
    });
</script>