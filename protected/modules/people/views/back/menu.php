<?php
$controller ='back';
switch($type){
	case ($type>=People::DEPARTMENTS and $type<People::LAW):
		$controller ='office';
		break;
	case ($type>=People::LAW and $type<People::TERR):
		$controller ='law';
		break;
	case ($type>=People::TERR and $type<People::IOGV):
		$controller ='terr';
		break;
	case ($type>=People::IOGV and $type<People::GOVERNMENT):
		$controller ='iogv';
		break;
	case ($type>=People::COMMITTEE and $type<People::EXPERT):
		$controller ='committee';
		break;
	case ($type>=People::POWER and $type<People::OTHER_POWER):
		$controller ='power';
		break;
	case ($type>=People::OTHER_POWER):
		$controller ='otherPower';
		break;
}
/**
 * @TODO специально для Александра
 * Ну и сравни if и switch для данного примера и что короче
 *
 * if($type>=People::DEPARTMENTS and $type<People::LAW)
		$controller ='office';
	elseif($type>=People::LAW and $type<People::TERR)
		$controller ='law';
	elseif($type>=People::TERR and $type<People::IOGV)
		$controller ='terr';
	elseif($type>=People::IOGV and $type<People::GOVERNMENT)
		$controller ='iogv';
 */


if(!Yii::app()->controller->isMainPortal() and $type==People::IOGV)
	$controller ='back';
?>

<div class="tabs">
	<div class="nav-tabs">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
			<li class="ui-state-default ui-corner-top <?php echo ($active == PeopleType::MAIN) ? 'ui-tabs-active ui-state-active' : ''; ?>">
				<a class="first-header list-group-item-people <?php echo ($isNewRecord)?"no-click":""?>"
				   href="<?php echo $this->createUrl('/people/'.$controller.'/update',array('people_id'=>(int)@$people_id)); ?>">
					<?php echo People::getTypeLabels($type)?>
				</a>
			</li>

			<?php if(!in_array($type,array_merge(array_keys(People::getTypeGroupLabels(People::TERR)),array_keys(People::getTypeGroupLabels(People::LAW))))){?>

				<li class="ui-state-default ui-corner-top <?php echo ($active == PeopleType::STAFF) ? 'ui-tabs-active ui-state-active' : ''; ?>">
					<a class="list-group-item-people <?php echo ($isNewRecord)?"no-click":""?>"
					   href="<?php echo $this->createUrl('/people/peopleStaff',array('people_id'=>(int)@$people_id)); ?>">Сотрудники</a>
				</li>
                <?php if(!in_array($type,array_merge(
                    array_keys(People::getTypeGroupLabels(People::COMMITTEE)),
                    array_keys(People::getTypeGroupLabels(People::EXPERT)),
//                    array_keys(People::getTypeGroupLabels(People::OTHER_POWER)),
                    array(People::TYPE_SOVET_FED,People::TYPE_IZBER,People::TYPE_AUDIT,People::LAW_CHILD,People::LAW_MAN,People::LAW_BUSINESSMAN)
                ))){?>
                        <li class="ui-state-default ui-corner-top <?php echo ($active == PeopleType::UNIT) ? 'ui-tabs-active ui-state-active' : ''; ?>">
					<a class="list-group-item-people <?php echo ($isNewRecord)?"no-click":""?>"
					   href="<?php echo $this->createUrl('/people/peopleUnit',array('people_id'=>(int)@$people_id)); ?>">Подразделения</a>
				</li>
				<?php } ?>
				<?php	if(in_array($type,array_merge(array_keys(People::getTypeGroupLabels(People::GOVERNOR)),array(People::IOGV)))){?>
					<li class="ui-state-default ui-corner-top <?php echo ($active == PeopleType::LIFE) ? 'ui-tabs-active ui-state-active' : ''; ?>">
						<a class="list-group-item-people <?php echo ($isNewRecord)?"no-click":""?>"
						   href="<?php echo $this->createUrl('/people/'.$controller.'/life',array('people_id'=>(int)@$people_id)); ?>">Биография</a>
					</li>
				<?php } ?>

                <?php if(!in_array($type,array_merge(
                    array_keys(People::getTypeGroupLabels(People::COMMITTEE)),
                    array_keys(People::getTypeGroupLabels(People::OTHER_POWER)),
                    array_keys(People::getTypeGroupLabels(People::EXPERT)),
                    array(People::TYPE_SOVET_FED)))){?>
				<li class="ui-state-default ui-corner-top <?php echo ($active == PeopleType::MAIN_INFO) ? 'ui-tabs-active ui-state-active' : ''; ?>">
					<a class="list-group-item-people <?php echo ($isNewRecord)?"no-click":""?>"
					   href="<?php echo $this->createUrl('/people/'.$controller.'/mainInfo',array('people_id'=>(int)@$people_id)); ?>">Общая информация</a>
				</li>
				<?php } ?>
            <?php if(!in_array($type,array_merge(
                    array_keys(People::getTypeGroupLabels(People::COMMITTEE)),
                    array_keys(People::getTypeGroupLabels(People::POWER)),
                    array_keys(People::getTypeGroupLabels(People::OTHER_POWER)),
                    array(People::IOGV)))){?>
				<li class="ui-state-default ui-corner-top <?php echo ($active == PeopleType::CONTACTS) ? 'ui-tabs-active ui-state-active' : ''; ?>">
					<a class="list-group-item-people <?php echo ($isNewRecord)?"no-click":""?>"
					   href="<?php echo $this->createUrl('/people/'.$controller.'/contacts',array('people_id'=>(int)@$people_id)); ?>">Контакты</a>
				</li>
                <?php } ?>
			<?php } ?>
			</ul>
	</div>
</div>
