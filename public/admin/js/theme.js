// Aşağısı silinecek

$('.cve-newsletter-form').on('submit', function (e) {
    e.preventDefault();
    cveThemeRequest(routes.newsletter_subscribe, $(this).serializeObject(), function (response) {});
});

// Yukarısı silinecek

function cveThemeRequest(url, data, callback, alert = true) {
    $.ajax(url, {
        type: 'POST',
        data: {
            cve_token: $('meta[name=X-CSRF-TOKEN]').attr('content'),
            ...data
        },
        success: function (response) {
            if(alert){
                if (typeof response.message === 'object'){
                    showSnackbar(response.status, Object.values(response.message)[0]);
                }else{
                    showSnackbar(response.status, response.message);
                }
            }
            callback(response)
        },
        error: function (xhr, opt, error) {
            if(alert){showSnackbar(false, error);}
            callback({
                status: false,
                message: error,
                data: {}
            })
        }
    });
}

function showSnackbar(status, message) {
    let snackbar = $('#cve-snackbar');

    if (status == 'success'){
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

/*
$(document).ready(function() {
    $(document).on('click', '.cve-bootstrap-dropdown-menu', function (e) {
        e.stopPropagation();
    });
    if ($(window).width() < 992) {
        $('.cve-bootstrap-dropdown-menu a').click(function(e){
            e.preventDefault();
            if($(this).next('.cve-bootstrap-submenu').length){
                $(this).next('.cve-bootstrap-submenu').toggle();
            }
            $('.dropdown').on('hide.bs.dropdown', function () {
                $(this).find('.cve-bootstrap-submenu').hide();
            })
        });
    }

});*/