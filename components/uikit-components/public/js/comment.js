$(document).on('click', '.uikit-comment-reply', function () {

    $('html,body').animate({
        scrollTop: $('#uikit-comment-form').offset().top
    }, 1000);

    let comment_id = $(this).data('id')
    let name = $(this).data('name')
    $('.uikit-comment-form').find('#comment_id').remove();
    $('.uikit-comment-reply-area').remove();
    $('<input>').attr({
        type: 'hidden',
        name: 'comment_id',
        value: comment_id,
        id: 'comment_id'
    }).appendTo('.uikit-comment-form');
    $('.uikit-comment-form').prepend('<div class="uk-width-1-1@s uikit-comment-reply-area"><div class="uk-alert-primary" uk-alert>' +
        '<a class="uikit-comment-reply-close-btn uk-alert-close" uk-close></a>' +
        '<p>' + name + ' ' + message.comment_reply + '</p>'+
        '</div></div>'
    )
});

$(document).on('click', '.uikit-comment-reply-close-btn', function () {
    $('.uikit-comment-reply-area').hide();
    $('#comment_id').remove();
})

$('.uikit-comment-form').on('submit', function (e) {
    e.preventDefault();
    let url = $(this).attr('action');
    cveThemeRequest(url, $(this).serializeObject(), function (response) {});
});
