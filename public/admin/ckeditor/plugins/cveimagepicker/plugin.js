CKEDITOR.plugins.add('cveimagepicker',
    {
        init: function (editor) {
            var pluginName = 'cveimagepicker';
            editor.ui.addButton('cvePicker',
                {
                    label: 'CVE Image Picker',
                    command: 'OpenWindow',
                    icon: CKEDITOR.plugins.getPath('cveimagepicker') + 'favicon.png'
                });
            var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
        }
    });
function showMyDialog(e) {
    window.editor = e;
    cve_request.get(adminImagePicker, {type: 'editor'}, function (response){
        $('.image-picker-content').html(response);
        $("#image-picker-modal").modal("show");
    }, false)
}