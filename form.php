<?

<form id="restoration_form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" class="b-cafe-form__form send_form">
    <div class="b-cafe-form__row row">
        <div class="col-md-6 col-lg-4">
            <div class="b-cafe-form__item">
                <label class="form-group">
                    <input required="" name="name" class="form-control" type="text" placeholder="<?php echo esc_attr( pll__( 'ФИО' ) ) ?>">
                </label>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="b-cafe-form__item">
                <label class="form-group">
                    <input required="" name="phone_email" class="form-control" type="text" placeholder="<?php echo esc_attr( pll__( 'Телефон или e-mail' ) ) ?>">
                </label>
            </div>
        </div>
        <div class="col-8 col-md-6 col-lg-3 col-xl-2">
            <div class="b-cafe-form__item">
                <label class="form-group">
                    <div class="form-label"><?php echo esc_attr( pll__( 'Дата' ) ) ?></div>
                    <div class="control-wrap is-active is-completed">
                        <input required="" name="date_order" class="form-control js-datepicker" type="text" value="24.07.2022"><img src="<?php echo get_template_directory_uri(); ?>/img/calendar.svg">
                    </div>
                </label>
            </div>
        </div>
        <div class="col-8 col-md-6 col-lg-3 col-xl-2">
            <div class="b-cafe-form__item">
                <div class="b-num-input">
                    <div class="b-num-input__label"><?php echo esc_attr( pll__( 'Количество гостей' ) ) ?>
                    </div>
                    <div class="b-num-input__border">
                        <div class="b-num-input__btn b-num-input__btn_minus">
                        </div>
                        <input name="count" class="b-num-input__input" value="1" type="number">
                        <div class="b-num-input__btn b-num-input__btn_plus">
                        </div>
                        <div class="b-num-input__ico"><img src="<?php echo get_template_directory_uri(); ?>/img/people.svg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b-cafe-form__snpd">
        <div class="form-group">
            <label class="checkbox">
                <input required="" type="checkbox" checked=""><span><?php echo esc_attr( pll__( 'Отправляя информацию, вы соглашаетесь с' ) ) ?> <a href="<?php echo esc_attr( pll__( 'время в пути 6 мин' ) ) ?>" target="_blank"><?php echo esc_attr( pll__( 'обработкой персональных данных' ) ) ?></a></span>
            </label>
        </div>
    </div>
    <input type="checkbox" name="form_anticheck" id="form_anticheck" class="form_anticheck" style="display: none !important;" value="true" checked="checked"/>
    <input type="text" name="form_submitted" id="form_submitted" value="" style="display: none !important;"/>
    <button class="b-cafe-form__btn" id="form_submit" type="submit">
        <span data-normal_text="<?php echo esc_attr( pll__( 'Отправить' ) ) ?>" data-error_text="Ошибка" data-success_text="Отправлено" data-progress_text="Отправляем"><?php echo esc_attr( pll__( 'Отправить' ) ) ?></span>
        <svg class="icon__str" width="27px" height="15px">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/img/svg-symbols.svg#str">
            </use>
        </svg>
    </button>
</form>
