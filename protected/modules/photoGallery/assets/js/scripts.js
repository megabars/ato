photosIndex = -1;

function reorder() {
    $('.gallery-photo').each(function(index) {
        console.log(index);
        $(this).find('.photo-sort').val(index + 1);
    });
}

$(document).ready(function() {

    $('body').on('click', '.drop-photo', function(e) {
        e.preventDefault();

        $(this).closest('.gallery-photo').remove();
        reorder();
    });

    $('body').on('click', '.sort-up', function(e) {
        e.preventDefault();

        var currentRow = $(this).closest('.gallery-photo');

        var swappedRow = currentRow.prev();

        if (swappedRow.hasClass('gallery-photo')) {
            var tmp = swappedRow.html();
            swappedRow.html(currentRow.html());
            currentRow.html(tmp);
            reorder();
        }
    });

    $('body').on('click', '.sort-down', function(e) {
        e.preventDefault();

        var currentRow = $(this).closest('.gallery-photo');

        var swappedRow = currentRow.next();

        if (swappedRow.hasClass('gallery-photo')) {
            var tmp = swappedRow.html();
            swappedRow.html(currentRow.html());
            currentRow.html(tmp);
            reorder();
        }
    });
})
