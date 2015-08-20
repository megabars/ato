<?php
/* @var $this SocialNetworkController */
/* @var $model SocialNetwork */

$this->breadcrumbs=array(
	'Ссылки на социальные сети'=>array('index'),
	SocialType::instance()->list[$type]
);

?>
<h1><?php echo SocialType::instance()->list[$type] ?></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>