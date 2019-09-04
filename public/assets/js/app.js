(function($) {$(document).on('change', '#registration_departement', function()
{
    let $field = $(this)
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('registration_departement', 'registration_ville')
    let data = {}
    data[$field.attr('name')] = $field.val()
    $.post($form.attr('action'), data).then(function (data) {
        let $input = $(data).find(target)
        $(target).replaceWith($input)
    })
})
})(jQuery);