<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = (($model)?$model->getTypeLabel():(!empty($this->type)?People::getTypeLabels($this->type):''));
$this->breadcrumbs['Органы власти'] = '/ORGANY-VLASTI';
if($this->middleBreadcrumbs !== null && is_array($this->middleBreadcrumbs)) {
	$this->breadcrumbs = array_merge($this->breadcrumbs, $this->middleBreadcrumbs);
}
$this->breadcrumbs[] = $this->pageTitle;
?>

<div class="wrap">
	<h2><?php echo $this->pageTitle?></h2>
	<?php if($model){?>
	<div class="clearfix">
		<?php echo $this->renderPartial('menu',array('model'=>$model));?>

		<div class="left-content">

			<div class="people clearfix">
				<?php echo $this->renderPartial('_left',array('model'=>$model));?>
                <?php if(in_array($model->type,array_merge(
                    array_keys(People::getTypeGroupLabels(People::POWER)),
                    array_keys(People::getTypeGroupLabels(People::OTHER_POWER))))){?>
                    <h4><?php echo $model->url?></h4>
                <?php } ?>
				<div class="right">
					<?php echo $model->main_info?>
				</div>
				<?php if($model->positionFile){ ?>
					<div class="files-list">
						<a href="/files/front/download/id/<?php echo  $model->positionFile?>" target="_blank" class="file file-pdf">положение о заместителе</a>
					</div>
				<?php } ?>

			</div>
		</div>

	</div>
	<?php }else{ ?>
		Ведомство <?php echo @People::getTypeLabels($this->type) ?> не заполнено
	<?php } ?>

</div>

