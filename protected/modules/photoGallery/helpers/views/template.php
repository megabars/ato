<?php
/**
 * @var $model CActiveRecord
 * @var $this FileUpload
 */
?>

<div class="qq-uploader">
    <div class="qq-upload-drop-area">
        <span>Переместите файлы в область</span>
        <div class="qq-upload-button btn btn-green">Загрузить файлы</div>
    </div>

<!--    <table>-->
<!--        <thead>-->
<!--            <tr>-->
<!--                <th>Фото</th>-->
<!--                <th>Описание</th>-->
<!--                <th>Опубликовано</th>-->
<!--                <th></th>-->
<!--            </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--            --><?php //foreach ($model->photoGalleryPhotos as $index => $item) : ?>
<!--                --><?php //$this->render('_row', array('item' => $item, 'name' => $name, 'id' => $item->photo)); ?>
<!--            --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->

    <ul class="qq-upload-list"></ul>
</div>