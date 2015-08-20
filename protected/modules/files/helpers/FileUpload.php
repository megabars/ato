<?php

/**
 * How to use
 * $this->widget('FileUpload', array(
    'model' => $model,
    'attribute' => 'photo',
    'config' => array('allowedExtensions' => array('pdf', 'jpg', 'png')),
    ));
 */

/**
 * Class FileUpload
 */
class FileUpload extends CInputWidget
{
    public $multiple = false;
    public $attrName = false;
    public $config = array();
    public $defaults = array();
    public $isImage = true;
    public $allowedExtensions = array("jpg", 'jpeg', 'gif', 'png', 'bmp');

//    protected  $imageExtensions = array("jpg", 'jpeg', 'gif', 'png', 'bmp');

    public function init()
    {
        // добавим allowedExtensions типа JPG и Jpg на фронт
        foreach ($this->allowedExtensions as $ext) {
            $this->allowedExtensions[] = strtoupper($ext);
            $this->allowedExtensions[] = ucfirst($ext);
        }

        $path = BaseActiveRecord::getUploadPath();

        list($name, $id) = $this->resolveNameID();

        $attrName = $this->attrName ? $this->attrName : get_class($this->model).'['. $this->attribute .']';

        if ($this->multiple)
            $attrName.='[]';


        $this->defaults = array(
            'allowedExtensions' => $this->allowedExtensions,
            'sizeLimit' => 500 * 1024 * 1024,
            'minSizeLimit' => 1,
            'action' => Yii::app()->createUrl('/files/front/upload/'),
            'onComplete' => "js:function(id, fileName, responseJSON) {
                if (responseJSON.error == undefined) {

                    var uploader = $('#" . $id . "');
                    var uploaderImage = uploader.find('.uploader-wrapper');
                    var uploaderTable = uploader.find('.qq-table-files .qq-table-files-list');

                    var templateImage = '<div class=\"uploader-image-preview\" style=\"background-image:url(\'" . $path . "' + responseJSON.filename + '\');\">'+ responseJSON.filename +'</div>'+
                                        '<span class=\"edit_file\"></span>'+
                                        '<span class=\"delete_file\" data-id=\"'+ responseJSON.id +'\"></span>'+
                                        '<input name=\"". $attrName ."\" value=\"'+ responseJSON.id +'\" type=\"hidden\">';

                    var templateFile = '<div class=\"uploader-image-preview preview-file\"><span>'+ responseJSON.basename +'</span></div>'+
                                        '<span class=\"edit_file\"></span>'+
                                        '<span class=\"delete_file\" data-id=\"'+ responseJSON.id +'\"></span>'+
                                        '<input name=\"". $attrName ."\" value=\"'+ responseJSON.id +'\" type=\"hidden\">';

                    var templateTableItems = '<div class=\"fileitem\">'+
                                                '<img src=\"" . $path . "'+ responseJSON.filename +'\"/>'+
                                                '<div class=\"filename\">'+ responseJSON.basename +'</div>'+
                                                '<span class=\"delete_file_multi\" data-id=\"'+ responseJSON.id +'\"></span>'+
                                                '<input name=\"". $attrName ."\" value=\"'+ responseJSON.id +'\" type=\"hidden\">'+
                                             '</div>';


                    if(responseJSON.is_image) {
                        uploaderImage.html(templateImage);
                        uploaderImage.addClass('show');

                        uploaderTable.append(templateTableItems);
                    }
                    else {
                        uploaderImage.html(templateFile);
                        uploaderImage.addClass('show');
                    }

                    uploader.find('.qq-upload-list').css('display', 'none');
                }
            }",
            'template' => $this->render( ($this->multiple === false )?'template':'templateMultiple', array(
                'model'     => $this->model,
                'attribute' => $this->attribute,
                'name'      => $name,
                'attrName'  => $attrName
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
        list($name, $id) = $this->resolveNameID();

        $config = array(
            'element' => 'js:document.getElementById("' . $id . '")',
            'debug' => false,
            'multiple' => $this->multiple,
            'params' => array(
                'PHPSESSID' => session_id(),
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        );

        $config = array_merge($this->config, $config);

        $config = CJavaScript::encode($config);

        echo CHtml::tag('div', array('id' => $id));
//        echo CHtml::closeTag('div'); // Лишний закрывающий тег. Из-за него в antiCorruption/document форма закрывается сразу после аплоадера
        // Но!!!! без него не отображаются вкладки после вкладки с аплоадером. Пока лечится добавлением закрывающего тега в проблемных местах )
        // @todo Надо это исправить

        self::registerScripts();

        Yii::app()->getClientScript()->registerScript("FileUploader_" . $id, "var FileUploader_" . $id . " = new qq.FileUploader($config); ", CClientScript::POS_LOAD);
    }

    /**
     * Добавить необходимые для работы uploader'a скрипты
     */
    public static function registerScripts(){
        $baseUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../assets');
        $clientScript = Yii::app()->getClientScript();

        $clientScript->registerScriptFile($baseUrl . '/js/fileuploader.js', CClientScript::POS_HEAD);
        $clientScript->registerScriptFile($baseUrl . '/js/back.js', CClientScript::POS_HEAD);
        $clientScript->registerCssFile($baseUrl . '/css/fileuploader.css');
    }

    /**
     * Проверка наличия значения аттрибута модели
     * @return bool
     */
    public function attributeFill()
    {
        $attribute = $this->attribute;

        return $this->model && $this->model->$attribute;
    }

    /**
     * Проверка, является ли атрибут "картинкой"
     * @return bool
     */
    public function isImage()
    {
        if(!$this->isImage) {
            $attribute = $this->attribute;
            $file = File::model()->findByPk($this->model->$attribute);
            return $file->isImage();
        } else {
            return TRUE;
        }
    }


}