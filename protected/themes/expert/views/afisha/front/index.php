<?php
/**
 * @var $this Controller
 * @var $records Afisha[]
 */

$this->pageTitle = 'Календарь мероприятий';

//$this->breadcrumbs = array(
//    $this->pageTitle
//);
?>

<div class="wrap inside-media">
    <?php $this->widget('application.modules.afisha.widgets.LatestEventsWidget',array('type'=>'month','date'=>date('d.m.Y'))); ?>
</div>