$(document).on('click', '.cve-liked', function (){
    cveThemeRequest(routes.content_like,{}, function (response) {
        if (response.status){
            $('.cve-like-count').text(response.data.likeCount)
        }
    });
});

function cveThemeRequest(url, data, callback)
{
    $.ajax(url, {
        type: 'POST',
        data: {
            cve_token: $('meta[name=X-CSRF-TOKEN]').attr('content'),
            ...data
        },
        success: function (response) {
            callback(response)
        },
        error: function (xhr, opt, error){
            callback({
                status: false,
                message: error,
                data: {}
            })
        }
    });
}