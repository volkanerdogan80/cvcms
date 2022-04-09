$('.uikit-contact-form').on('submit', function (e) {
    e.preventDefault();
    let url = $(this).attr('action');
    cveThemeRequest(url, $(this).serializeObject(), function (response) {});
});