<?php
/** @var $this AllPhotoController */
/** @var $model PhotoGalleryPhotos */

$this->breadcrumbs = array(
    'Фотоархив',
);
?>

<div class="page-header">
    <h2>Фотоархив</h2>
</div>

<div class="list-group">

</div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enableSorting' => false,
    'summaryText' => '',
    'template' => "{items}{pager}",
    'columns' => array(
        array(
            'header' => 'Фото',
            'type' => 'raw',
            'value'=>function ($data) {
                return '<a href="'.$data->getImageUrl().'"><img src="'.$data->getSmallUrl().'" /></a>';
            },
        ),
        'title',
        array(
            'header' => 'Загружен для',
            'type' => 'raw',
            'value'=>function ($data) {
                $page = StaticPage::model()->findByAttributes(array('photo_gallery_id'=>$data->photoGallery->id));
                if(isset($page)) {
                    return '<b>Страница:</b><br><a href="/'.$page->url->url.'">'.$page->title.'</a>';
                } else {
                    return '<b>Фотогалерея:</b><br><a href="/photoGallery/front/view/galleryId/'.$data->photoGallery->id.'">'.$data->photoGallery->title.'</a>';
                }
            },
        ),
        array(
            'header' => 'Тип',
            'type' => 'raw',
            'value'=>'@$data->file->ext',
        ),
        array(
            'header' => 'Размер',
            'type' => 'raw',
            'value'=>'@File::getFileSize($data->photo, "Mb")',
        ),
        array(
            'header' => 'Дата загрузки',
            'type' => 'raw',
            'value'=>'@date("d.m.Y", $data->file->date)',
        ),
        array(
            'header' => 'Загрузил',
            'type' => 'raw',
            'value'=>'@User::model()->findByPk($data->file->user_id)->username',
        ),
        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{update}',
            'buttons' => array(
                'update' => array(
                    'url' => function ($data) {
                        $page = StaticPage::model()->findByAttributes(array('photo_gallery_id'=>$data->photoGallery->id));
                        if(isset($page)) {
                            return Yii::app()->createUrl("/pages/back/update/", array("type"=>0,"id" => $page->id));
                        } else {
                            return Yii::app()->createUrl("/photoGallery/back/update/", array("id" => $data->photoGallery->id));
                        }
                    },
                ),
            ),
        ),
    ),
)); ?>