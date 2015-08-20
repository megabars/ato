$(document).ready(function() {
    $('.category-checkbox').on('ifChanged', function(e) {

        var categories = [];

        $(this).closest('.body').find('.category-checkbox').each(function() {
            if ($(this).prop('checked')) {
                categories.push($(this).attr('data-id'));
            }
        });

        $('.opendata-category').val(categories.join(','));

        $('#search-form').submit();
    });

    $('.portal-checkbox').on('ifChanged', function(e) {

        var portals = [];

        $(this).closest('.body').find('.portal-checkbox').each(function() {
            if ($(this).prop('checked')) {
                portals.push($(this).attr('data-id'));
            }
        });

        $('.opendata-portal').val(portals.join(','));

        $('#search-form').submit();
    });

    $('.check-all-iogv').on('click', function(e) {
        e.preventDefault();

        var $self = $(this);

        if ($(this).hasClass('all')) {
            $(this).removeClass('all');

            $(this).closest('.collapsed').find('.portal-checkbox').each(function() {
                $(this).prop('checked', 'checked');
            });
        }
        else {
            $(this).addClass('all');

            $(this).closest('.collapsed').find('.portal-checkbox').each(function() {
                $(this).removeProp('checked');
            });
        }

        var portals = [];

        $(this).closest('.collapsed').find('.portal-checkbox').each(function() {
            if ($(this).prop('checked')) {
                portals.push($(this).attr('data-id'));
            }
        });

        $('.opendata-portal').val(portals.join(','));

        $('#search-form').submit();
    });

    $('.check-all-category').on('click', function(e) {
        e.preventDefault();

        var $self = $(this);

        if ($(this).hasClass('all')) {
            $(this).removeClass('all');

            $(this).closest('.collapsed').find('.category-checkbox').each(function() {
                $(this).prop('checked', 'checked');
            });
        }
        else {
            $(this).addClass('all');

            $(this).closest('.collapsed').find('.category-checkbox').each(function() {
                $(this).removeProp('checked');
            });
        }

        var categories = [];

        $(this).closest('.collapsed').find('.category-checkbox').each(function() {
            if ($(this).prop('checked')) {
                categories.push($(this).attr('data-id'));
            }
        });

        $('.opendata-category').val(categories.join(','));

        $('#search-form').submit();
    });
});