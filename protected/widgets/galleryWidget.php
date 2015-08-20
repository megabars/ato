<?php
/**
 * author: Mikhail Matveev
 * Date: 17.12.14 
 */

Yii::import('zii.widgets.CListView');

class galleryWidget extends CListView {

    public $alias = null;
    public $galleryModel = null;
    public $itemsTagName = 'ul';
    public $template = "<div class='gallery-slider'><div>{items}</div><a href='#' class='prev'></a><a href='#' class='next'></a></div>";
    public $itemView = 'application.themes.tomsk.views.main._gallery';

    protected  $galleryId = null;

    public function init(){

        if ($this->alias === null && $this->galleryModel === null)
            throw new CHttpException(500, 'Wrong galleryWidget widget usage, define alias variable');

        if ($this->galleryModel === null)
            $gallery = PhotoGallery::model()->findByAttributes(array('alias' => $this->alias));
        else
            $gallery = $this->galleryModel;

        if ($gallery !== null && $this->alias != 'main') {
            $photos = new PhotoGalleryPhotos();
            $photos->photo_gallery_id = $gallery->id;
            $this->galleryId = $gallery->id;
            $this->dataProvider = $photos->search();
        }
        elseif ($gallery !== null && $this->alias == 'main') {
            $photos = new PhotoGallery();
            $photos->date = null;
            $this->dataProvider = $photos->published()->search();
        }
        else {
            throw new CHttpException(500, 'Wrong galleryWidget widget usage, gallery with current alias is not exists');
        }

        parent::init();
    }

    public function run() {
        parent::run();
        $url = Yii::app()->controller->createUrl('/photoGallery/front/view', array('galleryId' => $this->galleryId));
        echo '<div class="foot clearfix"><a href="'.$url.'" class="fr">Все фото</a></div>';
    }


}