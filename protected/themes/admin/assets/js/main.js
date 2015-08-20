$(function(){

    /*
     * Быстрое добавление записи
     */
    $(document).on("click", ".dropdown", function(e){
        e.stopPropagation();
        $(this).toggleClass('open').find(".dropdown-list").toggle();
    });
    $(".dropdown.open").click(function (e) {
        e.stopPropagation();
    });
    $(document).on("click", function(e){
        if (!$(e.target).parents().andSelf().is('.open')) {
            $(".dropdown.open").removeClass('open').find(".dropdown-list").hide();
        }
    });

    /*
     * Уведомления/Ошибки сайта
     * закрытие окна
     */
    $(document).on("click", ".alert .close", function(e){
        $(this).closest(".alert").hide();
    });

    $(document).on("click", ".toggle-date", function(e){
        $('#News_date').focus()
    });


    $('nav .dropdown-toggle > span, nav .dropdown-toggle > a').on('click',function(e) {
        e.preventDefault();
        $(this).next('ul').toggleClass('show');
    });

    /*
     * Раскрываем меню, если проваливаемся на внутренние страницы
     */
    var active = $('.main-menu').find('li.active');
    active.closest('ul').addClass('show');
    active.closest('ul').parent().closest('ul').addClass('show');
    active.closest('ul').parent().closest('ul').parent().closest('ul').addClass('show');
    active.closest('ul').parent().closest('ul').parent().closest('ul').parent().closest('ul').addClass('show');



    //$(".grid-view input[type='checkbox']").iCheck({
    //    checkboxClass: "icheckbox",
    //    radioClass: "iradio"
    //});


    // Переключалка активного/не активности модуля
    //$(document).on('click', '.module-list .toggle-module', function(e){
    //    e.preventDefault();
    //    var $this = $(this);
    //    var elem = $(this).closest('.item');
    //
    //    if(elem.hasClass('active') == true) {
    //        $this.removeClass('icon-off').addClass('icon-on').text('Подключить');
    //        elem.removeClass('active');
    //    }
    //    else {
    //        $this.removeClass('icon-on').addClass('icon-off').text('Отключить');
    //        elem.addClass('active');
    //    }
    //});

    // Accordion module
    $(document).on('click', '.module-list .head', function(e){
        e.preventDefault();
        var elem = $(this).closest('.item');

        if($(e.target).closest('.setting').length === 0) {
            if(elem.hasClass('active') == false) {
                elem.addClass('active').siblings().removeClass('active');
                elem.find('.body').slideDown();
                elem.siblings().find('.body').slideUp();
            }
            else {
                elem.removeClass('active');
                elem.find('.body').slideUp();
            }
        }
    });

    // Если на странице присутствует список молулей, то первый делаем открытым
    if($('.module-list').length > 0) {
        $('.module-list .item').first().find('.head').click();
    }


    // Открыть попап с формами для наполнения/редактирования
    $(document).on('click', '.open-settings', function(){
        $(this).closest('.item').find('.popup-module').fadeIn();
    });

    // Закрыть попап
    $(document).on('click', '.popup-close', function(){
        $(this).closest('.popup-module').fadeOut();
    });

    $(document).on('click', '.ui-dialog-titlebar-close', function(){
        overlayHide();
    });

    $('.scroll-pane').jScrollPane({
        showArrows: false,
        autoReinitialise: true
    });

    $(document).on('click','.change-image-field .dotted-link',function() {
        $(this).hide();
        $(this).next('.form-image-desc').show();
    });

    $(document).on('click','.change-image-field .button-accept',function() {
        var $this = $(this);
        var $value = $this.closest('.form-image-desc').find('input').val();
        $.post('/photoGallery/back/updatePhoto?id=' + $this.data('id') + '&name=' + $value)
            .success(function(data){
                if(data == 'success') {
                    $this.closest('.change-image-field').find('.error').html('').hide();
                    $this.closest('.form-image-desc').hide();
                    $this.closest('.change-image-field').find('.dotted-link').html($value).show();
                } else {
                    var $error = JSON.parse(data);
                    $this.closest('.change-image-field').find('.error').html($error.title[0]).show();
                }
            })
    });

    $(document).on('click','.change-image-field .button-cancel',function() {
        $(this).closest('.form-image-desc').hide();
        $(this).closest('.change-image-field').find('.dotted-link').show();
    });

    $(".chosen-select").chosen();

});

function overlayShow(){
    $('.overlay').fadeIn(200);
}
function overlayHide(){
    $('.overlay').fadeOut(200);
}