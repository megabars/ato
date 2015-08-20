<?php
/**
 * @var $model CActiveRecord
 * @var $this FileUpload
 */
?>
    <div class="qq-upload-drop-area">
        <span>Переместите файлы в область</span>
        <div class="qq-upload-button btn btn-green">Загрузить файл</div>
    </div>

    <?php
        $params = array(
            'attributeFill' => $this->attributeFill(),
            'model' => $model,
            'attribute' => $attribute,
        );

        $this->render('image_file', $params);
        $this->render('simple_file', $params);

        echo CHtml::activeHiddenField($model, $attribute);
    ?>

    <ul class="qq-upload-list"></ul>