$(document).ready(function () {

    $('.sortable').nestedSortable({
        forcePlaceholderSize: true,
        listType: 'ul',
        handle: 'div',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        errorClass: 'placeholder-error',
        revert: 250,
        tolerance: 'pointer',
        toleranceElement: '> div',
        maxLevels: 5,
        isTree: true,
        expandOnHover: 700,
        startCollapsed: true
    });

    $('.disclose').on('click', function() {
        $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
    });

    $('.menu-items-list').on('click', '.edit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            success: function(data) {
                $('#navigation_ajax_popup').html(data);
                $("#navigation_dialog").dialog("open");
            },
            cache: false
        });
        return false;
    }).on('click', '.remove', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            beforeSend: function() {
                if(!confirm('Вы уверены, что хотите удалить элемент?')) {
                    return false;
                } else {
                    $("#navigation-list").addClass("loader");
                }
            },
            success: function() {
                window.location.reload();
            },
            cache: false
        });
        return false;
    });



    $('#sorting').on('click', function () {

        var items = [];
        var i = 1;

        $('.sortable>li').each(function () {
            var $wrapper = $(this).find('div');

            items.push({
                'id': $wrapper.data('id'),
                'name': $wrapper.first().text(),
                'parent_id': 0,
                'ordi': i,
                'state': $wrapper.first().hasClass('disable') ? 0 : 1
            });

            i++

            $(this).find('li').each(function () {
                var $wrapper = $(this).find('div');

                items.push({
                    'id': $wrapper.data('id'),
                    'name': $wrapper.first().text(),
                    'parent_id': $(this).closest('ul').prev('div').data('id'),
                    'ordi': i,
                    'state': $wrapper.first().hasClass('disable') ? 0 : 1
                });

                i++
            });
        });

        $('#navigation-list').addClass('loader');

        $.post(
            $(this).data('url'),
            {
                data: JSON.stringify(items)
            },
            function(data, textStatus) {

                var text = (data && textStatus == 'success')?'Порядок сохранен':'Порядок не сохранен';
                $('#navigation-list').removeClass('loader');
                $("#message_dialog").dialog("option", "title", text).dialog("open");

                setTimeout(function(){
                    $("#message_dialog").dialog("close");
                }, 3000)
            },
            'json'
        );
    });
})