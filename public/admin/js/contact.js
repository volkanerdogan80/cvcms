$(document).on('click', '.contact-phone-add', function (e){
    let clone = $('#contact-phone-field').clone();
    let name = $(this).data('name');
    let number = $(this).closest('.card-body').find('.phone-field').length;
    clone = $(clone).css('display', 'flex');
    clone.removeAttr( "id" );
    clone.find('#phone-name').attr('name', 'contact['+name+'][phones][phone'+number+'][name]');
    clone.find('#phone-number').attr('name', 'contact['+name+'][phones][phone'+number+'][number]');
    $(this).closest('.card-body').find('#contact-phone-area').append(clone);
});

$(document).on('click', '.contact-email-add', function (e){
    let clone = $('#contact-email-field').clone();
    let name = $(this).data('name');
    let number = $(this).closest('.card-body').find('.email-field').length;
    clone = $(clone).css('display', 'flex');
    clone = clone.removeAttr( "id" );
    clone.find('#email-name').attr('name',  'contact['+name+'][emails][email'+number+'][name]');
    clone.find('#email-email').attr('name', 'contact['+name+'][emails][email'+number+'][email]');
    $(this).closest('.card-body').find('#contact-email-area').append(clone);
});

$(document).on('click', '.contact-phone-remove', function (e){
    $(this).closest('.phone-field').remove();
});

$(document).on('click', '.contact-email-remove', function (e){
    $(this).closest('.email-field').remove();
});

$(document).on('click', '.office-remove', function (e){
    $(this).closest('.card').remove();
});