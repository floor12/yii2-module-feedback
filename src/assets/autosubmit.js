$(document).on('change', 'form.autosubmit', function () {
    submitForm($(this));
});

$(document).on('keyup', 'form.autosubmit', function () {
    submitForm($(this));
});

function submitForm(form) {
    let method = form.attr('method');
    let action = form.attr('action');
    let container = form.data('container');
    $.pjax.reload({
        url: action,
        method: method,
        timeout: 10000,
        container: container,
        data: form.serialize()
    })

}
