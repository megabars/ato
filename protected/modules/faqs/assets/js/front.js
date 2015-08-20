$(document).ready(function() {
    $('ul.faq>li>span').on('click', function () {
        if ($(this).closest('li').hasClass('open')) {
            $(this).next('div').slideUp().closest('li').removeClass('open');
        }
        else {
            $(this).next('div').slideDown().parent().addClass('open');
            $(this).closest('li').siblings('li').find('div').slideUp().closest('li').removeClass('open');
        }
    });
});