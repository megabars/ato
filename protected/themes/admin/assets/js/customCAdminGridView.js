$(document).ready(function() {
    $('.remove-all').on('click', function (e) {
        e.preventDefault();

        var confirmText = $(this).data('confirm');
        if(typeof confirmText == 'undefined')
            confirmText = 'Вы действительно хотите удалить выбранные элементы?';

        if (confirm(confirmText)) {

            var gridId = $('.grid-view').attr('id'),
                checkName = 'ids[]',
                dataGridId = $(this).data('grid-id'),// если на странице несколько гридов, то указываем id нужного через data атрибут
                relatedGrids = $(this).data('related-grids'), //список связанных гридов, которые нужно обновить. передается через data атрибут
                functions = $(this).data('functions'), //список названий функций, которые необходимо выполнить здесь
                countId = $(this).data('count-id'); //если нужно обновить счетчик записей

            if(typeof dataGridId !== 'undefined') {
                gridId = $(this).data('grid-id');
                checkName = dataGridId+'-ids[]';
            }

            $.post(
                $(this).attr('href'),
                {
                    ids: $('#' + gridId).yiiGridView('getChecked', checkName)
                },
                function(data, textStatus) {
                    if (textStatus == 'success') {
                        $.fn.yiiGridView.update(gridId);

                        if(typeof relatedGrids !== 'undefined') {
                            var relatedGridsArray = relatedGrids.replace(' ', '').split(',');
                            for(var i=0;i<relatedGridsArray.length;i++) {
                                $.fn.yiiGridView.update(relatedGridsArray[i]);
                            }
                        }

                        if(typeof functions !== 'undefined') {
                            var funcArray = functions.replace(' ', '').split(',');
                            for(var i=0;i<funcArray.length;i++) {
                                window[funcArray[i]]();
                            }
                        }

                        if(typeof countId !== 'undefined') {
                            var count = (parseInt(data)>0)? "("+data+")" : "(пусто)";
                            $('#'+countId).text(count);
                        }
                    }
                    else {
                        alert('Не удалось удалить выбранные записи!');
                    }
                },
                'json'
            );
        }
    });
    $('.export-all').on('click', function (e) {
        e.preventDefault();

        var confirmText = $(this).data('confirm');
        if(typeof confirmText == 'undefined')
            confirmText = 'Вы действительно хотите экспортировать выбранные элементы?';

        if (confirm(confirmText)) {

            var gridId = $('.grid-view').attr('id'),
                checkName = 'ids[]',
                dataGridId = $(this).data('grid-id'),// если на странице несколько гридов, то указываем id нужного через data атрибут
                relatedGrids = $(this).data('related-grids'), //список связанных гридов, которые нужно обновить. передается через data атрибут
                functions = $(this).data('functions'), //список названий функций, которые необходимо выполнить здесь
                countId = $(this).data('count-id'); //если нужно обновить счетчик записей

            if(typeof dataGridId !== 'undefined') {
                gridId = $(this).data('grid-id');
                checkName = dataGridId+'-ids[]';
            }

            $.post(
                $(this).attr('href'),
                {
                    ids: $('#' + gridId).yiiGridView('getChecked', checkName)
                },
                function(data, textStatus) {
                    if (textStatus == 'success') {
                        alert('Экспорт был проведен успешно!');
                    }
                    else {
                        alert('Не удалось экспортировать выбранные записи!');
                    }
                },
                'json'
            );
        }
    });
});