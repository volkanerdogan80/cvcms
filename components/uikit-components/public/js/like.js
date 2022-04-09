$('.animation-like-button').on('click', function(e) {
    let classControl = $(this).hasClass('animation-liked');
    if (!classControl){
        $(this).toggleClass('animation-liked');
    }
});

$(document).on('click', '.animation-liked', function () {
    let url = $(this).data('url');
    let content_id = $(this).data('content');
    cve_liked(url, content_id);
});

function cve_liked(url, content_id){
    cveThemeRequest(url, {id: content_id}, function (response) {
        if (response.status) {
            $('.animation-'+content_id+'-content-like-count').text(response.data.likeCount)
        }
    });
}