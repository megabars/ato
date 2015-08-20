(function($) {
    var connector = function(itemNavigation, carouselStage) {
        return carouselStage.jcarousel('items').eq(itemNavigation.index());
    };

    $(function() {
        var carouselStage      = $('.carousel-stage').jcarousel({wrap: 'circular'});
        var carouselNavigation = $('.carousel-navigation').jcarousel();

        carouselNavigation.jcarousel('items').each(function() {
            var item = $(this);
            var target = connector(item, carouselStage);
            item

                .on('jcarouselcontrol:active', function() {
                    carouselNavigation.jcarousel('scrollIntoView', this);
                    item.addClass('active');
                })
                .on('jcarouselcontrol:inactive', function() {
                    item.removeClass('active');
                })
                .jcarouselControl({
                    target: target,
                    carousel: carouselStage
                });
        });

        $('.carousel-stage').jcarousel().jcarouselAutoscroll({
            interval: 5000,
            target: '+=1',
            autostart: true
        })

        $('.head-carousel .prev-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.head-carousel .next-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        $('.head-carousel .jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();

        // убираем всплытие события, чтобы ссылка работала без костылей
        $('.carousel.carousel-navigation a').on('click', function(e){
            e.stopPropagation();
        })
    });

    $(function() {
        $('.right-slider .slide')
            .on('jcarousel:targetin', 'li', function() {
                $('.right-slider .name').animate({'bottom':$(this).find('.desc').height()});
            })
            .on('jcarousel:targetout', 'li', function() {
                $(this).removeClass('active');
            })
            .jcarousel({wrap: 'circular'})
            .jcarouselAutoscroll({
                interval: 5000,
                target: '+=1',
                autostart: true
            });

        $('.right-slider .prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.right-slider .next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.right-slider .pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();
    });


    $(function() {
        var jcarousel = $('.wigets-link');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var width = jcarousel.innerWidth();
                if (width >= 1100) {
                    width = width / 6;
                } else if (width >= 900) {
                    width = width / 5;
                } else if (width >= 800) {
                    width = width / 4;
                }
                jcarousel.jcarousel('items').css('width', width + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('.wigets-link .prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.wigets-link .next')
            .jcarouselControl({
                target: '+=1'
            });
    });
})(jQuery);

$(document).ready(function(){

    var nav = $('.nav .wrap > ul > li');
    nav.each(function(){
        if($(this).index() < nav.length / 2)
            $(this).addClass('left');
        else
            $(this).addClass('right');
    });

    $("input.styled").iCheck({
        checkboxClass: "icheckbox",
        radioClass: "iradio"
    });

    if($('.block-link-custom').find('li').length <= 2) {
        $('.block-link-custom').addClass('block-link-custom-two');
    }
    else if ($('.block-link-custom').find('li').length == 3) {
        $('.block-link-custom').addClass('block-link-custom-three');
    }

    iogv();

    $('.collapses').on('click', '.item .title',function(){
        var $this = $(this);
        $this.closest('.item').children('.desc').slideToggle();
        setTimeout(function(){
            $this.closest('.item').toggleClass('active');
        },300)
    });

    if($('.collapses') && $('body').hasClass('page-invalid-version') == false) {
        var item = $('.collapses').find('.item');
        if(item.length >= 2) {
            item.first().find('.title').click();
        }
        else {
            item.first().find('.title').click();
            item.first().next().find('.title').click();
        }
    }

    $('.collapsed .title').on('click',function(){
        $(this).closest('.collapsed').find('.body').slideToggle();
        $(this).closest('.collapsed').toggleClass('hide');
    });

    if($.fancybox) {
        $(".fancybox").fancybox({
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'padding'           : 0,
            'speedIn'           : '500',
            'speedOut'          : '500',
            'helper'            :{
                title : {
                    type : 'bottom'
                }
            }
        });
        $(".fancy").fancybox({
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'padding'           : 0,
            'speedIn'           : '500',
            'speedOut'          : '500',
            'type'              : 'ajax',
            'minWidth'          : 700,
            "scrolling"         : false,
            'autoScale'         : false,
            'autoDimensions'    : false
        });

        $(".fancybox-maps").fancybox({
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'padding'           : 0,
            'speedIn'           : '500',
            'speedOut'          : '500',
            'type'              : 'ajax',
            'href'              : '/main/yandex',
            'minWidth'          : 700,
            "scrolling"         : false,
            'autoScale'         : false,
            'autoDimensions'    : false
        });
    }

    $(document).on('click','.feedback-type a',function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.feed-type').val($(this).data('id'))

        if($(this).data('id') == 2){
            $('.toggle-questions').hide();
            $('.modal-quetions').hide();
            $('#feedback_text').html('Описание проблемы <span class="required">*</span>');
        }
        else if($(this).data('id') == 3){
            $('.toggle-questions').hide();
            $('.modal-quetions').hide();
            $('#feedback_text').html('Предложить идею или написать отзыв <span class="required">*</span>');
        }
        else if($(this).data('id') == 4){
            $('.toggle-questions').hide();
            $('.modal-quetions').hide();
            $('#feedback_text').html('Описание технической проблемы <span class="required">*</span>');
        }
        else {
            $('.toggle-questions').show();
            $('.modal-quetions').hide();
            $('#feedback_text').html('Ваш вопрос <span class="required">*</span>');
        }
        return false;
    });

    $(document).on('click','.toggle-questions',function(){
        $(this).toggleClass('open');
        $(this).next('.modal-quetions').slideToggle();
    });

    $(".select").selecter();

    $('#toggle-search').on('click',function(e){
        if($(this).html() == 'свернуть')
            $(this).html('расширенный поиск');
        else
            $(this).html('свернуть');

        $('.grid-search').find('.search-min').toggle();
        $('.grid-search').find('.search-max').toggle();

        e.preventDefault();
    });
    $('.grid-search .hide').on('click',function(e){
        $('.grid-search').find('.search-min').show();
        $('.grid-search').find('.search-max').hide();
        $('#toggle-search').html('расширенный поиск');
        e.preventDefault();
    });

    $('#max-search').on('click',function(e){
        if($(this).html() == 'Скрыть расширенныей поиск') {
            $(this).html('Расширенный поиск');
            $('#max-search-content').slideUp();
        }
        else {
            $(this).html('Скрыть расширенныей поиск');
            $('#max-search-content').slideDown();
        }
        e.preventDefault();
    });


    if($.datepicker) {
        $.datepicker.regional['ru'] = {
            closeText: 'Закрыть',
            prevText: '&#x3c;Пред',
            nextText: 'След&#x3e;',
            currentText: 'Сегодня',
            monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
            monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                'Июл','Авг','Сен','Окт','Ноя','Дек'],
            dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
            dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
            dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
            weekHeader: 'Не',
            dateFormat: 'dd.mm.yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['ru']);
    }

    $(document).on('click','.alert .alert-close',function(){
        $(this).closest('.alert').fadeOut();
    });

    var gallerycarousel = $('.gallery-slider > div');

    if(gallerycarousel.find('ul li').length < 6) {
        $('.gallery-slider').addClass('mini');
        $('.gallery-slider').parent().next('.foot').hide();
    }

    gallerycarousel
        .on('jcarousel:reload jcarousel:create', function () {
            var width = gallerycarousel.width();

            if (width >= 1000) {
                width = width / 6;
            } else if (width <= 999) {
                width = width / 5;
            } else if (width <= 869) {
                width = width / 4;
            }

            gallerycarousel.jcarousel('items').css('width', width + 'px');
        })
        .jcarousel();

    $('.gallery-slider .prev')
        .jcarouselControl({
            target: '-=1'
        });

    $('.gallery-slider .next')
        .jcarouselControl({
            target: '+=1'
        });


    $('.right-slide .slide')
        .on('jcarousel:targetin', 'li', function() {
            $(this).addClass('active');
        })
        .on('jcarousel:targetout', 'li', function() {
            $(this).removeClass('active');
        })
        .jcarousel({
            wrap:'circular',
            animation: {
                duration: 200,
                easing:   'linear'
            }
        })
        .jcarouselAutoscroll({
            interval: 5000,
            target: '+=1',
            autostart: true
        });;

    $('.right-slide .next')
        .jcarouselControl({
            target: '+=1'
        });

    $.fn.replaceText = function( search, replace, text_only ) {
        return this.each(function(){
            var node = this.firstChild,
                val,
                new_val,
                remove = [];
            if ( node ) {
                do {
                    if ( node.nodeType === 3 ) {
                        val = node.nodeValue;
                        new_val = val.replace( search, replace );
                        if ( new_val !== val ) {
                            if ( !text_only && /</.test( new_val ) ) {
                                $(node).before( new_val );
                                remove.push( node );
                            } else {
                                node.nodeValue = new_val;
                            }
                        }
                    }
                } while ( node = node.nextSibling );
            }
            remove.length && $(remove).remove();
        });
    };

    $(document).on('click', '#close-fancy', function(){
        $('.fancybox-overlay').remove();
    });

    //if($('.table.bigTable').size())
    $('.table.bigTable').fixedTable({height: 700});
});


$(window).resize(function(){
    iogv();
});

function iogv(){
    var contacInfo = $('.contact-info').not('.type2');

    if ( $('.iogv-header').find('.iogv-menu').height() < $('.iogv-header').find('.portal-info').height()) {
        contacInfo.width($('.wrap').width());
    }
    else {
        contacInfo.width($('.wrap').width() - ($('.iogv-menu').width() + 30) );
    }
}

function withoutCyr(input) {
    var value = input.value;
    var re = /а|б|в|г|д|е|ё|ж|з|и|й|ё|к|л|м|н|о|п|р|с|т|у|ф|х|ц|ч|ш|щ|ъ|ы|ь|э|ю|я/gi;
    if (re.test(value)) {
        value = value.replace(re, '');
        input.value = value;
    }
}
