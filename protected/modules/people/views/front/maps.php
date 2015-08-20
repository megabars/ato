<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Местное самоуправление';
$this->breadcrumbs[]=$this->pageTitle;
?>

<div class="wrap">
    <h2>Местное самоуправление</h2>
    <div class="custom-content">
        <div class="article">
            <?php echo @PeopleLocal::model()->findByAttributes(array('portal_id' => $this->portalId))->text; ?>
        </div>

    </div>

    <div class="files-list">
        <ul>
            <li>
                <a href="/uploads/pdf/реестр 2014 на 1 декабря 2014.pdf" target="_blank" class="file file-pdf">Реестр административно-территориальных единиц Томской области</a>
            </li>
        </ul>
    </div>

    <div class="maps-svg mt30">
        <?php $this->widget('application.widgets.mapsWidget',array('people'=>true)); ?>
    </div>
</div>