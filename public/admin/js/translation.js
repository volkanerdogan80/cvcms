$(document).on('click', '.language_select', function (){
    $('.language_select').removeClass('active');
    $(this).addClass('active');

    let lang = $(this).data('lang');
    let url = $(this).data('url');

    cve_request.post(url, {lang: lang}, function (response){
        if(response.status){
            $('#folder_list').html(response.view);
        }
    }, false);

})