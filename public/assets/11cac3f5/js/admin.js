$(document).ready(function() {

    if ($(".datepicker").size()) {
        $(".datepicker").datepicker();
    }

    if ($('.ckeditor').size()) {

        $('.ckeditor').each(function() {
            var itemId = $(this).attr('id');

/*            var editor = CKEDITOR.replace(itemId, {
                toolbar : [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                    { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    '/',
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                    '/',
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
                ],
                filebrowserBrowseUrl : jsPath + '/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : jsPath + '/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : jsPath + '/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : jsPath + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : jsPath + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : jsPath + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });*/

            var editor = CKEDITOR.replace(itemId, {
                toolbar : [
                    { items: [ 'Bold','Italic','Underline', '-', 'Link','Blockquote','Source', '-', 'BulletedList','NumberedList','JustifyBlock','JustifyCenter','JustifyLeft','JustifyRight','-', 'FontSize','TextColor', '-', 'Undo', 'Redo', '-', 'Image','Table'  ] },
                ],
                height: 260,
                filebrowserBrowseUrl : jsPath + '/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : jsPath + '/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : jsPath + '/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : jsPath + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : jsPath + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : jsPath + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });

            CKFinder.setupCKEditor(editor, '/uploads/ckfinder/');
        });
    }
});