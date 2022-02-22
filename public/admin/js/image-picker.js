$(document).on('click', '.single-image-picker', function (){
    cve_request.get(adminImagePicker, {
        src: $(this).data('src'),
        input: $(this).data('input'),
        type: 'single'
    }, function (response){
        $('.image-picker-content').html(response);
        $("#image-picker-modal").modal("show");
    }, false)
    return false;
})

$(document).on('click', '.multi-image-picker', function (e){
    cve_request.get(adminImagePicker, {
        area: $(this).data('area'),
        input: $(this).data('input'),
        type: 'multi'
    }, function (response){
        $('.image-picker-content').html(response);
        $("#image-picker-modal").modal("show");
    }, false)
    return false;
})


$(document).on('click', '.image-url-copy', function (){
    let copyText = document.getElementById("image-url-input");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
});

$(document).on('change', 'input[name=imagecheck]', function (){
    let url = $(this).data('original');
    $('.image-url-input').val(url);
});

$(document).on('click', '.image-picker-select', function (){
    let modal = $('#image-picker-modal');
    let selectImage = modal.find('input:radio:checked');
    let imageID = selectImage.data('id');
    let imageSRC = selectImage.data('src');
    modal.modal('hide');

    let src = modal.find('#single-modal-attribute').data('src');
    let input = modal.find('#single-modal-attribute').data('input');

    $('#'+input).val(imageID);
    $('#'+src).attr('src', imageSRC);
});

$(document).on('click', '.images-picker-select', function (){
    let modal = $('#image-picker-modal');
    let idList = modal.find('input:checked:checked').map(function (){
        return $(this).data('id');
    }).get();
    let srcList = modal.find('input:checked:checked').map(function (){
        return $(this).data('src');
    }).get();
    modal.modal('hide');

    let area = modal.find('#multi-modal-attribute').data('area');
    let inputName = modal.find('#multi-modal-attribute').data('input');
    let input = '';
    $.each(idList, function (index, item){
        input = input + '<div class="col-6 col-sm-2">\n' +
            '<label class="mb-4">\n' +
            '<input type="hidden" name="'+inputName+'[]" value="'+item+'">'+
            '<img style="width: 187px; height: 134px;" src="'+srcList[index]+'" class="imagecheck-image">\n' +
            '</label>\n' +
            '</div>';
    });

    $('#'+area).prepend(input);
})

$(document).on('click', '.image-picker-use', function (){
    let url = $('.image-url-input').val();
    window.editor.insertHtml('<img src="'+url+'" />');
    $("#image-picker-modal").modal("hide");
})

$(document).on('click', '.gallery-item-delete', function (){
    $(this).closest('.gallery-item').remove();
});