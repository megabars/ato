(function($) {
    $(function() {
        $(document).on('click', '.delete_file', function () {
            var $that = $(this);

            $.ajax({
                url: '/files/back/delete',
                data: {
                    id: $that.attr('data-id')
                },
                success: function (data) {
                    if (data == 'success') {
                        $that.attr('data-id', '')
                        $that.closest('li').remove();
                        $that.closest('.qq-uploader').find('.uploader-wrapper').removeClass('show');
                        $('.qq-upload-files').hide();
                        $that.closest('.qq-uploader').find('input:hidden').val('');
                        $that.closest('.uploader-wrapper').find('input:hidden').val('');
                    }
                }
            })
        });

        $(document).on('click', '.delete_file_multi', function () {
            var $that = $(this);

            $.ajax({
                url: '/files/back/delete',
                data: {
                    id: $that.attr('data-id')
                },
                success: function (data) {
                    if (data == 'success') {
                        $that.attr('data-id', '')
                        $that.closest('.fileitem').hide();
                        $that.closest('.fileitem').find('input:hidden').val('');
                    }
                }
            })
        });

        $(document).on('click','.edit_file',function(){
            $(this).closest('.qq-uploader').find('.qq-upload-button input').click();
        });
    });
})(jQuery);