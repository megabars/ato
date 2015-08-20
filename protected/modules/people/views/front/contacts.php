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
$this->breadcrumbs[] = 'Контакты';
?>

<div class="wrap">
	<h2><?php echo $this->pageTitle ?></h2>

	<div class="clearfix">
		<?php echo $this->renderPartial('menu',array('model'=>$model));?>
		<div class="left-content">
			<div class="contact-info type2 mt0">
				<div class="clearfix">

					<?php echo $this->renderPartial('_left',array('model'=>$model,'lite'=>true,'contact'=>true));?>

					<div class="desc">
						<div class="title"><?php echo $model->contact_name;?></div>

						<?php if(!empty($model->job)): ?>
							<div class="row">
								<span class="label">Место работы, должность:</span><?php echo $model->job; ?>
							</div>
						<?php endif; ?>
						<?php if(!empty($model->contact_address)): ?>
							<div class="row">
								<span class="label">Адрес</span><?php echo $model->contact_address;?>
							</div>
						<?php endif; ?>
						<?php if(!empty($model->contact_phone)): ?>
							<div class="row">
								<span class="label">Телефон:</span><a
									href="tel:<?php echo $model->contact_phone; ?>"><?php echo $model->contact_phone; ?></a>
							</div>
						<?php endif; ?>
						<?php if(!empty($model->contact_email)): ?>
							<div class="row">
								<span class="label">Email</span>
								<a href="mailto:<?php echo $model->contact_email; ?>"
								   class="mail"><?php echo $model->contact_email; ?></a>
							</div>
						<?php endif; ?>
						<?php if(!empty($model->contact_site)): ?>
							<div class="row">
								<span class="label">Сайт:</span>
								<a href="<?php echo $model->contact_site; ?>"><?php echo $model->contact_site; ?></a>
							</div>
						<?php endif; ?>
						<?php if(!empty($model->contact_fax)): ?>
							<div class="row">
								<span class="label">Факс:</span><?php echo $model->contact_fax; ?>
							</div>
						<?php endif; ?>
						<?php if(!empty($model->contact_description)): ?>
							<div class="row">
								<span class="label">Описание:</span><?php echo $model->contact_description; ?>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="people">
								<div class="left">
									<div class="social">
										<?php if(!empty($model->social_vk)): ?>
											<a class="vk" target="_blank" href="<?php echo $model->social_vk; ?>"></a>
										<?php endif; ?>
										<?php if(!empty($model->social_tw)): ?>
											<a class="tw" target="_blank" href="<?php echo $model->social_tw; ?>"></a>
										<?php endif; ?>
										<?php if(!empty($model->social_fb)): ?>
											<a class="fb" target="_blank" href="<?php echo $model->social_fb; ?>"></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php if(!empty($model->contact_address)): ?>
					<div class="maps-widget">
						<div id="legislativeDumaMap"></div>
						<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
						<script>
							ymaps.ready(init);

							function init () {


								var lan = 56.485918;
								var lon = 84.946113;

								$.ajax({
									url: "http://geocode-maps.yandex.ru/1.x/?format=json&geocode=<?php echo $model->contact_address;?>",
									async:false,
									success: function (data) {
										var addr = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos;
										var addr_arr = addr.split(" ");
										lon = addr_arr[0];
										lan = addr_arr[1];
									}
								});

								var myMap = new ymaps.Map("legislativeDumaMap", {
										center: [lan, lon],
										zoom: 16,
										controls: ['smallMapDefaultSet']
									}),
									myPlacemark = new ymaps.Placemark([lan, lon], {
										balloonContentHeader: "<?php echo $model->full_name;?>",
										balloonContentBody: "",
										balloonContentFooter: "<?php echo $model->contact_address;?>",
										hintContent: "<?php echo $model->full_name;?>"
									});
								myMap.geoObjects.add(myPlacemark);
							}
						</script>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
