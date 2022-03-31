<?

// Ниже все для формы

// Регистрируем и вызываем скрипт под аякс
add_action( 'wp_enqueue_scripts', 'ajax_form_scripts');
function ajax_form_scripts() {

    // Обработка полей формы
    wp_enqueue_script( 'jquery-form' );

    // Подключаем скрипты формы
    wp_enqueue_script( 'ajax-form', get_theme_file_uri( '/js/ajax_form.js' ), array('jquery'), 1.2, true );
    wp_localize_script( 'ajax-form', 'ajax_form_object', array(
    'url'   => admin_url( 'admin-ajax.php' ),
    'nonce' => wp_create_nonce( 'ajax-form-nonce' ),
    ));

}


// Обработчик php для аякс формы
add_action('wp_ajax_ajax_form_action', 'ajax_action_callback');
add_action('wp_ajax_nopriv_ajax_form_action', 'ajax_action_callback');

function ajax_action_callback()
{

    // Массив ошибок
    $errors = [];

    // Если не прошла проверка nonce, то блокируем отправку
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-form-nonce')) {
        wp_die('Данные отправлены с некорректного адреса');
    }

    // Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
    if ($_POST['form_anticheck'] === false || !empty($_POST['form_submitted'])) {
        wp_die('Спам');
    }


    // Проверяем поля  если пусто, то пишем флаг в массив ошибок

    if (empty($_POST['name']) || !isset($_POST['name'])) {
        $errors['name'] = true;
    } else {
        $stripped['name'] = sanitize_text_field($_POST['name']);
    }

    if (empty($_POST['phone_email']) || !isset($_POST['phone_email'])) {
        $errors['phone_email'] = true;
    } else {
        $stripped['phone_email'] = sanitize_text_field($_POST['phone_email']);
    }

    if (empty($_POST['date_order']) || !isset($_POST['date_order'])) {
        $errors['date_order'] = true;
    } else {
        $stripped['date_order'] = sanitize_text_field($_POST['date_order']);
    }

    if (empty($_POST['count']) || !isset($_POST['count'])) {
        $errors['count'] = true;
    } else {
        $stripped['count'] = sanitize_text_field($_POST['count']);
    }


    if ($errors) 
    {
        wp_send_json_error($errors);
    } 
    else 
    {

        $subject = 'Сообщение с сайта';

        // Указываем адресаты
        $email_to = 'abashyrov12@gmail.com';
        $message = '<h1>Запрос индивидуального предложения с oakleafresidences.com</h1><p><b>Имя</b>: '. $stripped['name'] .'</p><p><b>Телефон или имейл</b>: '. $stripped['phone_email'] .'</p><p><b>Дата</b>: '. $stripped['date_order'] .'</p><p><b>Количество гостей</b>: '. $stripped['count'] .'</p>';

        $headers = array(
            "Content-type: text/html; charset=utf-8",
            "From: "      . $stripped['name'] . " <no-reply@oakleafresidences.com>",
            "Reply-To: "  . $stripped['phone_email'] . " <" . $stripped['phone_email'] . ">"
        );

        // Отправляем
        wp_mail($email_to, $subject, wpautop($message), $headers);

        // Отправляем сообщение об успешной отправке
        $message_success = true;
        wp_send_json_success($message_success);
    }

    // Убиваем процесс ajax
    wp_die();
}
