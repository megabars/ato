<?php
/**
 * @var $model CActiveRecord
 * @var $this FileUpload
 */
?>

<?php
    $file = File::model()->findByPk($model->$attribute);
    $attributeFill = $this->attributeFill();
    $display = $attributeFill && $file;
    $id = $attributeFill ? $model->$attribute : '';
    //is_callable(array($model, 'getSmallUrl'),true);

    $img_src = ($file && $this->isImage() && $model->asa('ImageBehavior')) ? $model->getSmallUrl($attribute) : '';
    $filename = ($attributeFill && $file) ? $file->origin_name : '';
    $size = ($attributeFill && $file) ?  $file->size : '';

    //var_dump(is_callable(array($model, 'getSmallUrl')));

$params = array(
        'display' => $display,
        'id' => $id,
        'img_src' => $img_src,
        'filename' => $filename,
        'model' => $model,
        'attribute' => $attribute,
        'size' => $size,
        'attrName' => $attrName
    );

    //echo CHtml::activeHiddenField($model, $attribute, array('name' => $name));
?>

<div class="qq-uploader<?php echo ($this->isImage) ? '':' qq-uploader-no-image' ?>" >
    <div class="qq-upload-drop-area">
        <span class="drop-area-help">Перетащите файл сюда</span>
        <div class="qq-upload-button">Выберите файл</div>
        <div class="max-file-size">Максимальный размер файла 5Мб</div>

        <?php
            if($this->isImage)
                $this->render('image_file', $params);
            else
                $this->render('simple_file', $params);
        ?>
    </div>

    <ul class="qq-upload-list"></ul>
</div>