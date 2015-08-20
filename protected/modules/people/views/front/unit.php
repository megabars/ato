<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = ($model)?$model->getTypeLabel():'';
$this->breadcrumbs['Органы власти'] = '/ORGANY-VLASTI';
if($this->middleBreadcrumbs !== null && is_array($this->middleBreadcrumbs)) {
	$this->breadcrumbs = array_merge($this->breadcrumbs, $this->middleBreadcrumbs);
}
$this->breadcrumbs[$this->pageTitle] = '/people/front/view/id/'.@$model->id.'/type/'.@$model->type.'/from/'.@$_GET['from'];
$this->breadcrumbs[] = 'Подразделения';
?>

<div class="wrap">
	<h2><?php echo $this->pageTitle?></h2>
	<div class="clearfix">
		<?php echo $this->renderPartial('menu',array('model'=>$model));?>
		<div class="left-content">

			<div class="people clearfix">

				<?php echo $this->renderPartial('_left',array('model'=>$model));?>
				<div class="right">
					<?php if(!in_array($model->type,array_keys(People::getTypeGroupLabels(People::LAW)))){?>
					<ul class="people-list">
						<?php
						if($model->unit)
							foreach($model->unit as $unit)

								if(!empty($unit->url))
								{?>
									<li>
										<div class="desc">
											<a class="name" target="_blank" href="<?php echo $unit->url;?>"><?php echo $unit->name;?></a>
										</div>
									</li>
								<?php }	?>
					</ul>
					<?php }	?>

					<div class="collapses">
						<?php
						if($model->unit)
							foreach($model->unit as $unit)
								//if(!empty($unit->content))
								{?>
									<div class="item">
										<div class="title">
											<div class="name"><?php echo $unit->name;?></div>
											<div class="toggle"></div>
										</div>
										<div class="desc">
											<div><?php echo $unit->content;?></div>
											<?php if($unit->staff){ ?>
												<ul class="people-list">
													<?php  foreach($unit->staff as $staff) {?>
														<li>
															<?php if(file_exists($staff->getImagePath('photo')) and !is_dir($staff->getImagePath('photo'))){?>
																<div class="image">
																	<img src="<?php echo $staff->getImageUrl('photo'); ?>"/>
																</div>
															<?php } ?>
															<div class="desc">
																<span style="color: #2995B2;"><?php echo $staff->full_name; ?></span>
																<div class="post"><?php echo $staff->job; ?></div>

																<ul>
																	<?php if(!empty($staff->cabinet)): ?>
																		<li>
																			<b>Кабинет:</b><?php echo $staff->cabinet; ?>
																		</li>
																	<?php endif; ?>
																	<?php if(!empty($staff->contact_phone)): ?>
																		<li>
																			<b>Телефон:</b><?php echo $staff->contact_phone; ?>
																		</li>
																	<?php endif; ?>
																	<?php if(!empty($staff->contact_fax)): ?>
																		<li>
																			<b>Факс:</b><?php echo $staff->contact_fax; ?>
																		</li>
																	<?php endif; ?>
																	<?php if(!empty($staff->contact_site)): ?>
																		<li>
																			<b>Сайт:</b>
																			<a href="<?php echo $staff->contact_site; ?>"><?php echo $staff->contact_site; ?></a>
																		</li>
																	<?php endif; ?>
																	<?php if(!empty($staff->contact_email)): ?>
																		<li>
																			<b>E-mail:</b>
																			<a href="mailto:<?php echo $staff->contact_email; ?>"><?php echo $staff->contact_email; ?></a>
																		</li>
																	<?php endif; ?>
																</ul>
															</div>
														</li>
													<?php }	?>
												</ul>
											<?php }	?>
										</div>
									</div>
								<?php }	?>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>

