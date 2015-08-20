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
class ManyFileUpload extends CInputWidget
{
    public $config = array();
    public $defaults = array();
    public $modelFieldClass = 'uploader-file';
    public $imageExtensions = array("jpg", 'jpeg', 'gif', 'png', 'bmp', 'doc', 'docx', 'pdf', 'xls', 'xlsx');
    public $is_new_name = false;
    public $relation = 'photoGalleryPhotos';

    public function init()
    {
        $path = BaseActiveRecord::getUploadPath();
        $relation = !empty($this->htmlOptions['relation'])?$this->htmlOptions['relation']:$this->relation;
        $label = !empty($this->htmlOptions['label'])?$this->htmlOptions['label']:'Загрузить файлы';
        if( !empty($this->htmlOptions['name'])) {
            $name = $this->htmlOptions['name'];
            $this->is_new_name = true;
        }
        else
            $name = get_class($this->model)."[".$this->relation."][]";

        $id=CHtml::getIdByName($name);

        $this->defaults = array(
            'allowedExtensions' => $this->imageExtensions,
            'sizeLimit' => 500 * 1024 * 1024,
            'minSizeLimit' => 1,
            'action' => Yii::app()->createUrl('/files/front/upload/').'?path='.CHtml::encode($path),
            'onComplete' => "js:function(id, fileName, responseJSON) {
                if (responseJSON.error == undefined) {
                    var uploader = $('#" . $this->getId() . "');
                        $('#" . $id . "').val(responseJSON.id);

                        uploader.find('.files-wrapper').append('' +
                        '<div class=\"uploader-many-image\">' +
                            '<input name=\"" . $name . "\" type=\"hidden\" value=\"' + responseJSON.id + '\" />' + responseJSON.basename +''+
                            '<span class=\"drop-many-file\" data-file=\"' + responseJSON.id + '\" >Удалить</span>'+
                        '</div>');


                    $('.qq-upload-drop-area').css('display', 'none');
                    uploader.find('.qq-upload-list').css('display', 'none');
                }
            }",
            'template' => $this->render('template_many', array(
                'model'     => $this->model,
                'attribute' => $this->attribute,
                'name'      => $name,
                'label'      => $label,
                'class'      => $this->modelFieldClass,
                'is_new_name'      => $this->is_new_name,
                'relation'      => $relation,
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
        echo CHtml::closeTag('div');

        $baseUrl = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../assets');
        $clientScript = Yii::app()->getClientScript();

        $clientScript->registerScriptFile($baseUrl . '/js/fileuploader.js', CClientScript::POS_HEAD);
        $clientScript->registerScriptFile($baseUrl . '/js/back.js', CClientScript::POS_HEAD);
        $clientScript->registerCssFile($baseUrl . '/css/fileuploader.css');

        $clientScript->registerScript("FileUploader_" . $this->getId(), "var FileUploader_" . $this->getId() . " = new qq.FileUploader($config); ", CClientScript::POS_LOAD);
    }

    /**
     * Проверка, является ли атрибут "картинкой"
     * @return bool
     */
    public function isImage()
    {
        $attribute = $this->attribute;

        $file = File::model()->findByPk($this->model->$attribute);

        if ($file)
            return in_array($file->ext, $this->imageExtensions);


        return FALSE;
    }
}