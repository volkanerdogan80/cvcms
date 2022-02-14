$(document).on('click', '.cve-liked', function (){
    cveThemeRequest(routes.content_like,{}, function (response) {
        if (response.status){
            $('.cve-like-count').text(response.data.likeCount)
        }
    });
});

$(document).on('click', '.cve-favorite', function (){
    cveThemeRequest(routes.content_favorite,{}, function (response) {
        if (response.status){
            $('.cve-favorite-count').text(response.data.favoriteCount)
        }
    });
});

$(document).on('click', '.cve-voted', function (){
    let vote = $(this).data('vote');

    cveThemeRequest(routes.content_vote,{vote: vote}, function (response) {
        if (response.status){

            $.each(response.data.voteList, function (i, item) {
                $('.cve-'+item.vote+'-vote').text(item.count);
            });

            let avg = parseFloat(response.data.ratingAvg);
            $('.cve-vote-avg').text(avg.toFixed(1));
        }
    });
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
    $('.cve-comment-form').prepend('<div class="cve-alert cve-primary cve-comment-reply-area">' +
        '<span class="cve-alert-close-btn cve-comment-reply-close-btn">&times;</span>' +
        ''+name+' '+message.comment_reply+'</div>'
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
            if(alert){showSnackbar(response.status, response.message);}
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