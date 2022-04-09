$(document).on('click', '.uikit-voted', function () {
    let url = $(this).data('url');
    let vote = $(this).data('vote');
    let content_id = $(this).data('content');
    cve_rating(url, content_id, vote);
});

function cve_rating(url, content_id, vote){
    cveThemeRequest(url, {id: content_id, vote: vote}, function (response) {
        if (response.status) {
            $.each(response.data.voteList, function (i, item) {
                $('.uikit-' + item.vote + '-text').text(item.count);
                $('.uikit-' + item.vote + '-value').val(item.count);
            });

            let avg = parseFloat(response.data.ratingAvg);
            $('.uikit-vote-avg').text(avg.toFixed(1));
        }
    });
}