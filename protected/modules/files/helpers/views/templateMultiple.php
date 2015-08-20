<?php
/**
 * @var $model CActiveRecord
 * @var $this FileUpload
 */
?>

<div class="qq-uploader qq-uploader-multiple">
    <div class="qq-upload-drop-area">
        <span class="drop-area-text">
            Перетащите файлы сюда
            <i>или</i>
         </span>
        <div class="qq-upload-button">Загрузить файлы</div>
        <i class="max-file-size">Максимальный размер файла 500Мб</i>
    </div>

    <?php
//    $file = File::model()->findByPk($model->$attribute);
//    $attributeFill = $this->attributeFill();
//    $display = $attributeFill && $file;
//    $id = $attributeFill ? $model->$attribute : '';
//    $img_src = ($file && $this->isImage()) ? $model->getSmallUrl($attribute) : '';
//    $filename = ($attributeFill && $file) ? $file->origin_name : '';
//
//    $params = array(
//        'display' => $display,
//        'id' => $id,
//        'img_src' => $img_src,
//        'filename' => $filename,
//        'model' => $model,
//        'attribute' => $attribute,
//    );

    $this->render('table_files', array('existFiles' => $model->$attribute, 'attribute' => $attribute, 'model' => $model));

    //echo CHtml::activeHiddenField($model, $attribute, array('name' => $name));
    ?>

    <ul class="qq-upload-list"></ul>
</div>