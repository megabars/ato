<div class="right-content">
	<div class="right-menu">
		<?php if($model->main_info or @$model->positionFile){?>
			<a href="/people/front/view/id/<?php echo @$model->id?>/from/<?php echo @$_GET['from']; ?>" class="<?php echo (Yii::app()->controller->action->id=='view')?'active':''?>">Общая информация</a>
		<?php } ?>
		<?php	if(in_array($model->type,array_merge(array_keys(People::getTypeGroupLabels(People::GOVERNOR)),array(People::IOGV)))  and $model->life){?>
			<a href="/people/front/life/id/<?php echo @$model->id?>/from/<?php echo @$_GET['from']; ?>" class="<?php echo (Yii::app()->controller->action->id=='life')?'active':''?>">Биография</a>
		<?php } ?>
		<?php if($model->staff){?>
			<a href="/people/front/staff/id/<?php echo @$model->id?>/from/<?php echo @$_GET['from']; ?>"  class="<?php echo (Yii::app()->controller->action->id=='staff')?'active':''?>">Сотрудники</a>
		<?php } ?>
		<?php if(!in_array($model->type,array(People::GOVERNOR,People::TYPE_SOVET_FED,People::TYPE_IZBER,People::TYPE_AUDIT,People::LAW_CHILD,People::LAW_MAN,People::LAW_BUSINESSMAN)) and $model->unit){?>
			<a href="/people/front/unit/id/<?php echo @$model->id?>/from/<?php echo @$_GET['from']; ?>" class="<?php echo (Yii::app()->controller->action->id=='unit')?'active':''?>">Подразделения</a>
		<?php } ?>
		<?php if(in_array($model->type,array(People::GOVERNOR))){?>
			<a href="/people/front/zam/id/<?php echo @$model->id?>/from/<?php echo @$_GET['from']; ?>" class="<?php echo (Yii::app()->controller->action->id=='zam')?'active':''?>">Заместители</a>
		<?php } ?>
		<a href="/people/front/contacts/id/<?php echo @$model->id?>/from/<?php echo @$_GET['from']; ?>" class="<?php echo (Yii::app()->controller->action->id=='contacts')?'active':''?>">Контакты</a>
	</div>
</div>