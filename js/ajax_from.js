jQuery(document).ready(function ($) {
    var form = $('#restoration_form');
    var form_submit = $('#form_submit > span');

    // Сбрасываем значения полей
    $('#restoration_form input, #restoration_form textarea').on('blur', function () {
        $('#restoration_form input').removeClass('error');
        form_submit.html(form_submit.data('normal_text'));
    });

    // Отправка значений полей
    var options = {
        url: ajax_form_object.url,
        data: {
            action: 'ajax_form_action',
            nonce: ajax_form_object.nonce
        },
        type: 'POST',
        dataType: 'json',
        beforeSubmit: function (xhr) {
            // При отправке формы меняем надпись на кнопке
            form_submit.html(form_submit.data('progress_text'));
        },
        success: function (request, xhr, status, error) {

            if (request.success === true) {
                // Если все поля заполнены, отправляем данные и меняем надпись на кнопке
                form_submit.html(form_submit.data('success_text'));
            } else {
                // Если поля не заполнены, выводим сообщения и меняем надпись на кнопке
                $.each(request.data, function (key, val) {
                    form.find("[attribute='"+key+"']").addClass('error');
                });
                form_submit.html(form_submit.data('error_text'));
            }
            // При успешной отправке сбрасываем значения полей
            form[0].reset();
        },
        error: function (request, status, error) {
            form_submit.html(form_submit.data('error_text'));
        }
    };
    // Отправка формы
    form.ajaxForm(options);
});
