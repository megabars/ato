<?php
/**
 * @var $this Controller
 * @var $records Afisha[]
 */

$this->pageTitle = 'Календарь заседаний';

?>

<div class="wrap inside-media ckeditor">
    <?php $this->widget('application.modules.afisha.widgets.LatestEventsWidget',array(
        'name' => 'Календарь заседаний',
        'type'=>'month',
        'date'=>date('d.m.Y'))); ?>
</div>