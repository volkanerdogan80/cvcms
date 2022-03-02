$(document).on('click', '.cve-liked', function (){
    let content_id = $(this).data('content');
    let content_like_count_selector = '.cve-'+content_id+'-content-like-count';
    let count_selector = $(this).data('count');
    if (count_selector){
        content_like_count_selector = count_selector;
    }
    cve_liked(content_id, content_like_count_selector);
});
function cve_liked(content_id, content_like_count_selector){
    cveThemeRequest(routes.content_like, {id: content_id}, function (response) {
        if (response.status) {
            $(content_like_count_selector).text(response.data.likeCount)
        }
    });
}

$(document).on('click', '.cve-favorite', function (){
    let content_id = $(this).data('content');
    let content_favorite_count_selector = '.cve-'+content_id+'-content-like-count';
    let count_selector = $(this).data('count');
    if (count_selector){
        content_favorite_count_selector = count_selector;
    }
    cve_favorite(content_id, content_favorite_count_selector);
});
function cve_favorite(content_id, content_favorite_count_selector){
    cveThemeRequest(routes.content_favorite, {id: content_id}, function (response) {
        if (response.status) {
            $(content_favorite_count_selector).text(response.data.favoriteCount)
        }
    });
}

function cve_rating(content_id, vote){
    cveThemeRequest(routes.content_vote, {id: content_id, vote: vote}, function (response) {
        if (response.status) {

            $.each(response.data.voteList, function (i, item) {
                $('.cve-' + item.vote + '-text').text(item.count);
                $('.cve-' + item.vote + '-value').val(item.count);
            });

            let avg = parseFloat(response.data.ratingAvg);
            $('.cve-vote-avg').text(avg.toFixed(1));
        }
    });
}
$(document).on('click', '.cve-voted', function (){
    let vote = $(this).data('vote');
    let content_id = $(this).data('content');
    cve_rating(content_id, vote);
});

$(document).on('click', '.cve-newsletter', function (){
    let email = $('.cve-newsletter-email').val();
    let name = $('.cve-newsletter-name').val();

    cveThemeRequest(routes.newsletter_subscribe,{email: email, name: name}, function (response) {});
    return false;
});

$('.cve-contact-form').on('submit', function (e){
    e.preventDefault();
    cveThemeRequest(routes.message_send, $(this).serializeObject(), function (response) {});
});

$('.cve-comment-form').on('submit', function (e){
    e.preventDefault();
    cveThemeRequest(routes.content_comment, $(this).serializeObject(), function (response) {});
});

$(document).on('click', '.cve-comment-reply', function () {

    $('html,body').animate({
        scrollTop: $('#cve-comment-form').offset().top
    }, 1000);

    let comment_id = $(this).data('id')
    let name = $(this).data('name')

    $('.cve-comment-form').find('#comment_id').remove();
    $('.cve-comment-reply-area').remove();
    $('<input>').attr({
        type: 'hidden',
        name: 'comment_id',
        value: comment_id,
        id: 'comment_id'
    }).appendTo('.cve-comment-form');
    $('.cve-comment-form').prepend('<div class="uk-width-1-1@s cve-comment-reply-area"><div class="uk-alert-primary" uk-alert>' +
        '<a class="uk-alert-close cve-comment-reply-close-btn" uk-close></a>' +
        '<p>'+name+' '+message.comment_reply+' </p>'+
        '</div></div>'
    )
});

$(document).on('click', '.cve-comment-reply-close-btn', function (){
    $('.cve-comment-reply-area').hide();
    $('#comment_id').remove();
})

function showSnackbar(status, message) {
    let snackbar = $('#cve-snackbar');

    if (status){
        $(snackbar).addClass('cve-success')
    }else{
        $(snackbar).addClass('cve-danger')
    }

    $(snackbar).addClass('cve-snackbar-show').text(message)

    setTimeout(function () {
            $(snackbar).removeClass('cve-snackbar-show cve-success cve-danger');
        }, 3000
    );
}

function cveThemeRequest(url, data, callback, alert = true)
{
    $.ajax(url, {
        type: 'POST',
        data: {
            cve_token: $('meta[name=X-CSRF-TOKEN]').attr('content'),
            ...data
        },
        success: function (response) {
            if(alert){
                if(typeof response.message === 'object'){
                    showSnackbar(response.status, Object.values(response.message)[0]);
                }else{
                    showSnackbar(response.status, response.message);
                }
            }
            callback(response)
        },
        error: function (xhr, opt, error){
            if(alert){showSnackbar(false, error);}
            callback({
                status: false,
                message: error,
                data: {}
            })
        }
    });
}

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};