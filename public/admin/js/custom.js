/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$("img.lazyload").lazyload();

let open_menu = localStorage.getItem('cve_open_menu');
if (open_menu){
    $('#' + open_menu).addClass('active');
}

$(document).on('click', '.clear-storage', function () {
    localStorage.removeItem('cve_open_menu');
})

$('.notification_send').click(function (){
    let url = $(this).data('url');
    let title = $('#notification-modal').find('#title').val();
    let description = $('#notification-modal').find('#description').val();
    let click_action = $('#notification-modal').find('#click_action').val();
    cve_request.post(url, {
        title: title,
        description: description,
        click_action: click_action,
    }, function (response){
        if(response.status){
            $('#notification-modal').modal('hide');
        }
    });
})

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
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

$(document).on('keyup', '#permit-filter', function (){
    let permit_list = $('.permit-list').find('li');
    let filter = $(this).val().toUpperCase();
    permit_list.each(function (index, item){
        let title = $(item).data('title').toUpperCase();
        let key = $(item).data('key');
        if (title.indexOf(filter) > -1){
            $('.' + key).removeClass('display-none');
        }else{
            $('.' + key).addClass('display-none');
        }
    })
})

$(document).on('keyup', '#social-filter', function (){
    let social_list = $('.social-list').find('.social-title');
    let filter = $(this).val().toUpperCase();
    social_list.each(function (index, item){
        let title = $(item).data('title').toUpperCase();
        if (title.indexOf(filter) > -1){
            $(item).closest('.social-group').show();
        }else{
            $(item).closest('.social-group').hide();
        }
    })
})

$(document).on('keyup', '#component-filter', function (){
    let social_list = $('.component-list').find('.component-title');
    let filter = $(this).val().toUpperCase();
    social_list.each(function (index, item){
        let title = $(item).data('title').toUpperCase();
        if (title.indexOf(filter) > -1){
            $(item).closest('.component-item').show();
        }else{
            $(item).closest('.component-item').hide();
        }
    })
})