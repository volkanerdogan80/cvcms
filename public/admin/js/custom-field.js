$(document).on('click', '.field-remove', function (){
    $(this).closest('.custom-field').remove();
    return false;
});

$('.new-field').click(function (){
    let type = $(this).data('type');
    let url = $(this).data('url');
    cve_request.get(url, {type: type}, function (response){
        $('#custom-field').append(response.view)
    });
})

$(document).on('change', '.post_format', function (){
    let format = $(this).children('option:selected').val();
    let url = $(this).data('url');
    cve_request.get(url, {format: format}, function (response){
        $('#format-custom-field').html('');
        $('#format-custom-field').append(response.view)
    }, false);
})