<?php
/* @var $this SocialNetworkController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ссылки на социальные сети',
);

?>

<h1>Ссылки на социальные сети</h1>

<div>
    <div class="social">
        ВКонтакте: <span><?php echo (!is_null($social['vk']) ? $social['vk'] : 'нет');  ?></span> <?php echo CHtml::link('Изменить', array('edit', 'type' => SocialType::VK)); ?>
    </div>

    <div class="social">
        Твиттер: <span><?php echo (!is_null($social['tw']) ? $social['tw'] : 'нет') ?></span> <?php echo CHtml::link('Изменить', array('edit', 'type' => SocialType::TWITTER)); ?>
    </div>

    <div class="social">
        Facebook: <span><?php echo (!is_null($social['fb']) ? $social['fb'] : 'нет') ?></span> <?php echo CHtml::link('Изменить', array('edit', 'type' => SocialType::FB)); ?>
    </div>
</div>
