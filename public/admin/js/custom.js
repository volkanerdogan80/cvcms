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