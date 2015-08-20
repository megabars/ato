<?php

require_once 'ECKEdit5.php';

class ECKEditor extends CInputWidget
{
    private $ECKE;

    private $_config = array(

    );

    public function init()
    {
        parent::init();

        $this->ECKE = new ECKEdit5();
    }

    public function run()
    {
        parent::run();

        // Saves $id will be the id of the element that ckeditor will target
        list($name, $id) = $this->resolveNameID();

        // Publish assets to public directory
        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir . DIRECTORY_SEPARATOR . 'assets');

        $this->_config = array(
            'height' => '500px',
            'language' => 'ru',
            'toolbar' => array(
                array(
                    'name'   => 'document',
                    'groups' => array('mode', 'document', 'doctools'),
                    'items'  => array('Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates'),
                ),
                array(
                    'name'   => 'clipboard',
                    'groups' => array('clipboard', 'undo'),
                    'items'  => array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
                ),
                array(
                    'name'   => 'editing',
                    'groups' => array('find', 'selection', 'spellchecker'),
                    'items'  => array('Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'),
                ),
                array(
                    'name'   => 'paragraph',
                    'groups' => array('list', 'indent', 'blocks', 'align', 'bidi'),
                    'items'  => array('NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'),
                ),
                array(
                    'name'   => 'links',
                    'items'  => array('Link', 'Unlink', 'Anchor'),
                ),
                array(
                    'name'   => 'insert',
                    'items'  => array('Image', 'Flash', 'Table', 'HorizontalRule', 'SpecialChar', 'Youtube'),
                ),
                array(
                    'name'   => 'basicstyles',
                    'groups' => array('basicstyles', 'cleanup'),
                    'items'  => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                ),
                array(
                    'name'   => 'styles',
                    'groups' => array('find', 'selection', 'spellchecker'),
                    'items'  => array('Styles', 'Format', 'Font', 'FontSize'),
                ),
                array(
                    'name'   => 'colors',
                    'groups' => array('find', 'selection', 'spellchecker'),
                    'items'  => array('TextColor', 'BGColor'),
                ),
            ),
            'filebrowserBrowseUrl'        => "{$assets}/ckfinder/ckfinder.html",
            'filebrowserImageBrowseUrl'   => "{$assets}/ckfinder/ckfinder.html?type=Images",
            'filebrowserFlashBrowseUrl'   => "{$assets}/ckfinder/ckfinder.html?type=Flash",
            'filebrowserUploadUrl'        => "{$assets}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
            'filebrowserImageUploadUrl'   => "{$assets}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
            'filebrowserFlashUploadUrl'   => "{$assets}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash",
        );

        $clientScript = Yii::app()->getClientScript();
        $clientScript->registerScriptFile($assets . '/ckeditor/ckeditor.js');
        $clientScript->registerScriptFile($assets . '/ckfinder/ckfinder.js');
        $clientScript->registerScript('ckfinder', "CKFinder.setupCKEditor(editor{$id}, '/uploads/ckfinder/');");

        echo CHtml::activeTextArea($this->model, $this->attribute, array('rows' => 20, 'cols' => 180));

        $this->ECKE->replace($id, $this->_config);
    }
}