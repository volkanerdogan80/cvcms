$(document).on('click', '#new-slider', function (){
    let url = $(this).data('url');
    cve_request.get(url, {}, function (response){
        $("#slider-item-list").prepend(response.view);
    }, false)
    return false;
})

$(document).on('click', '.slider-new-text-item', function (){
    let url = $(this).data('url');
    let id = $(this).data('id');
    cve_request.get(url, {id: id}, function (response){
        $('.'+id+'-text-list').prepend(response.view);
    }, false)
    return false;
})

$(document).on('click', '.slider-new-button-item', function (){
    let url = $(this).data('url');
    let id = $(this).data('id');
    cve_request.get(url, {id: id}, function (response){
        $('.'+id+'-button-list').prepend(response.view);
    }, false)
    return false;
})

$(document).on('click', '.slider-card-remove', function (){
    $(this).closest('.card').remove();
})

$(document).on('click', '.slider-card-collapse', function (){
    let id = $(this).data('id');
    $('#'+id+'-collapse').collapse("toggle")
})
