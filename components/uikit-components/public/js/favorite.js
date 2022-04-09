$(document).on('click', '.animation-favorite', function () {
    let url = $(this).data('url');
    let content_id = $(this).data('content');
    let classControl = $(this).hasClass('animation-favorited');
    if (!classControl){
        $(this).addClass('animation-favorited');
    }else{
        $(this).removeClass('animation-favorited');
    }

    cve_favorite(url, content_id);
});

function cve_favorite(url, content_id){
    cveThemeRequest(url, {id: content_id}, function (response) {
        if (response.status) {
            $('.animation-'+content_id+'-content-favorite-count').text(response.data.favoriteCount)
        }
    });
}