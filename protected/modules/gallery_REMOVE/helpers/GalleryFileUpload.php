<?php

/**
 * Class GalleryFileUpload
 */
class GalleryFileUpload extends CInputWidget
{
    public $config = array();
    public $defaults = array();

    public function init()
    {
        $path = PhotoGalleryPhotos::getUploadPath();

        list($name, $id) = $this->resolveNameID();

        $this->defaults = array(
            'allowedExtensions' => array("jpg", 'jpeg', 'gif', 'png', 'bmp'),
            'sizeLimit' => 500 * 1024 * 1024,
            'minSizeLimit' => 1,
            'action' => Yii::app()->createUrl('/files/front/upload/', array('portal' => false)),
            'onComplete' => "js:function(id, fileName, responseJSON) {
                if (responseJSON.error == undefined) {
                    var uploader = $('#" . $this->getId() . "');

                    $('tbody').append(" . CJavaScript::encode($this->render('_row', array('item' => null, 'name' => $name, 'id' => 0), true)) . ");

                    var tr = $('tbody').find('tr:last');
                    tr.find('.gallery-image').html('<img width=\"50\" height=\"50\" src=\"" . $path . "' + responseJSON.filename + '\" />');
                    tr.find('[name=\"{$name}[0][photo]\"]').val(responseJSON.id);
                    tr.find('[name=\"{$name}[0][photo]\"]').attr('name', '{$name}[' + photosIndex + '][photo]');
                    tr.find('[name=\"{$name}[0][title]\"]').attr('name', '{$name}[' + photosIndex + '][title]');
                    tr.find('[name=\"{$name}[0][ordi]\"]').attr('name', '{$name}[' + photosIndex + '][ordi]');
                    tr.find('[name=\"{$name}[0][state]\"]').attr('name', '{$name}[' + photosIndex + '][state]');
                    reorder();
                    photosIndex--;

                    uploader.find('.qq-upload-list').css('display', 'none');
                }
            }",
            'template' => $this->render('template', array(
                'model'     => $this->model,
                'attribute' => $this->attribute,
                'name'      => $name,
            ), true),
            'messages' => array(
                'typeError'     => 'Неверное расширение файла "{file}". Разрешены форматы: {extensions}.',
                'sizeError'     => "{file} слишком большой, максимальный размер файла {sizeLimit}.",
                'minSizeError'  => "{file} слишком маленький, минимальный размер файла {minSizeLimit}.",
                'emptyError'    => "{file} пустой, выберите другой файл.",
                'onLeave'       => "Загрузка файла еще не закончена, вы хотите завершить загрузку?"
            ),
            'showMessage' => "js:function(message) {
                alert(message);
            }"
        );
    }

    public function run()
    {
        $this->config = array_merge($this->defaults, $this->config);

        $config = array(
            'element' => 'js:document.getElementById("' . $this->getId() . '")',
            'debug' => false,
            'multiple' => true,
            'params' => array(
                'PHPSESSID' => session_id(),
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        );

        $config = array_merge($this->config, $config);

        $config = CJavaScript::encode($config);

        echo CHtml::tag('div', array('id' => $this->getId()));

        $baseUrl = Yii::app()->assetManager->publish(Yii::app()->getModule('files')->getBasePath() . '/assets');
        $clientScript = Yii::app()->getClientScript();

        $clientScript->registerScriptFile($baseUrl . '/js/fileuploader.js', CClientScript::POS_HEAD);
        $clientScript->registerScriptFile($baseUrl . '/js/back.js', CClientScript::POS_HEAD);
        $clientScript->registerCssFile($baseUrl . '/css/fileuploader.css');

        $clientScript->registerScript("FileUploader_" . $this->getId(), "var FileUploader_" . $this->getId() . " = new qq.FileUploader($config); ", CClientScript::POS_LOAD);

        $baseUrl = Yii::app()->assetManager->publish(__DIR__ . '/../assets');
        $clientScript->registerScriptFile($baseUrl . '/js/scripts.js', CClientScript::POS_HEAD);
    }
}