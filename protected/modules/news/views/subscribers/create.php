<?php
/* @var $this SubscribersController */
/* @var $model NewsSubscribers */

$this->breadcrumbs=array(
    'Новости' => '/news/back/index',
    'Подписчики' => '/news/subscribers/index',
    'Добавление подписчика'
); ?>

<h1>Добавление подписчика</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>