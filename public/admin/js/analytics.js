setInterval(function () {
    cve_request.post(admin_realtime_visitors, {}, function (response) {
        if (response.status) {
            if($('#visitorMap').length){
                setRealTimeVisitorsData(response.data);
            }
            $('.analytics-realtime-visitors').text(response.online)
        }
    }, false)
}, 10000)

function setRealTimeVisitorsData(data) {
    $('.analytics-realtime-data').html('');
    $(document).find('.jqvmap-region').attr('fill', '#ddd')
    $.each(data, function (index, item) {
        let code = getCountryCode(item[1]);
        jQuery('#visitorMap').vectorMap('set', 'colors', {[code]: '#6777ef'});
        //TODO: Hangi ülkeden bağlanıldığını gösterebiliriz. Canlı test yapılırken bakılacak.
        let list_item = '<li class="list-group-item d-flex justify-content-between align-items-center">' + item[0] + '<span class="badge badge-primary badge-pill">' + item[5] + '</span></li>';
        $('.analytics-realtime-data').append(list_item);
    })
}

function getCountryCode(country) {
    let code = "tr";
    $.each(countries, function (index, item){
        if (item == country){
            code = index;
        }
    })
    return code.toLowerCase();
}


$('.daterange-analytics').daterangepicker({
    locale: {
        format: 'YYYY-MM-DD',
        cancelLabel: 'Vazgeç'
    },
    drops: 'left',
    opens: 'left',
    "autoApply": false,
    ranges: {
        [daterange.today]: [moment(), moment()],
        [daterange.yesterday]: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        [daterange.last_7_days]: [moment().subtract(6, 'days'), moment()],
        [daterange.last_30_days]: [moment().subtract(29, 'days'), moment()],
        [daterange.this_month]: [moment().startOf('month'), moment().endOf('month')],
        [daterange.last_month]: [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "alwaysShowCalendars": true,
});