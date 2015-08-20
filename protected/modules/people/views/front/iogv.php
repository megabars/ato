<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = (($model)?$model->getTypeLabel():(!empty($this->type)?People::getTypeLabels($this->type):''));
//$this->breadcrumbs[] = $this->pageTitle;
?>

<div class="wrap">
	<h2><?php echo $this->pageTitle?></h2>
	<?php if($models){?>
	<div class="clearfix people-iogv-list">

		<?php foreach($models as $model){?>
			<div class="people people-iogv">
				<div class="left clearfix">

					<div class="name"  style="font-weight: bold;  font-size: 16px;">
						<a href="/people/front/life/id/<?php echo $model->id; ?>"><?php echo $model->job; ?></a>
					</div>
						<div class="image" style="max-height: 200px;overflow: hidden">
							<img style="max-width: 200px;height: auto" src="<?php echo  ((file_exists($model->getImagePath('photo')) and !is_dir($model->getImagePath('photo')))?$model->getImageUrl('photo'):$this->getAssetsBase().'/images/person.jpg'); ?>"/>
						</div>
						<div class="name"  style="font-weight: bold;"><?php echo $model->full_name; ?></div>

						<ul>
							<?php if(!empty($model->contact_address)){ ?>
								<li>
									<b style="font-weight: bold;">Адрес:</b> <?php echo $model->contact_address; ?>
								</li>
							<?php } ?>
							<?php if(!empty($model->contact_phone)){ ?>
								<li>
									<b style="font-weight: bold;">Телефон:</b> <?php echo $model->contact_phone; ?>
								</li>
							<?php } ?>
							<?php if(!empty($model->contact_fax)){ ?>
								<li>
									<b style="font-weight: bold;">Факс:</b> <?php echo $model->contact_fax; ?>
								</li>
							<?php } ?>
							<?php if(!empty($model->contact_site)){ ?>
								<li>
									<b style="font-weight: bold;">Сайт:</b> <a href="<?php echo $model->contact_site; ?>"><?php echo $model->contact_site; ?></a>
								</li>
							<?php } ?>
							<?php if(!empty($model->contact_email)){ ?>
								<li>
									<b style="font-weight: bold;">E-mail:</b> <a href="mailto:<?php echo $model->contact_email; ?>"><?php echo $model->contact_email; ?></a>
								</li>
							<?php } ?>
						</ul>

						<div class="social">
							<?php  if(!empty($model->social_vk)) : ?>
								<a class="vk" target="_blank" href="<?php echo $model->social_vk; ?>"></a>
							<?php endif; ?>
							<?php  if(!empty($model->social_tw)) : ?>
								<a class="tw" target="_blank" href="<?php echo $model->social_tw; ?>"></a>
							<?php endif; ?>
							<?php  if(!empty($model->social_fb)) : ?>
								<a class="fb" target="_blank" href="<?php echo $model->social_fb; ?>"></a>
							<?php endif; ?>
						</div>
				</div>
			</div>
		<?php } ?>

	</div>
	<?php }else{ ?>
		Ведомство <?php echo @People::getTypeLabels($this->type) ?> не заполнено
	<?php } ?>

</div>

