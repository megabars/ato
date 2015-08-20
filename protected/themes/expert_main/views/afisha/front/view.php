<?php

$this->renderPartial('application.modules.afisha.views.front.view',array(
    'record' => $record,
    'time' => $time,
));

$this->pageTitle = 'Календарь мероприятий - '.$record->title;

$this->breadcrumbs = array(
    'Пресс-Центр',
    'Календарь заседаний' => $this->createUrl('/afisha/front/index'),
    $record->title
);
?>