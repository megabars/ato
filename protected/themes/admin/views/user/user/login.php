<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<div class="login">
	<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

		<div class="success">
			<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
		</div>

	<?php endif; ?>

<!--	<a href="" class="logo"></a>-->
	<div class="title">
		Административная панель<br/>
		Комплекса программных средств портала исполнительных органов государственной власти Томской области
	</div>

	<div class="form">

		<div class="head">
			<?php echo UserModule::t("Login"); ?>
		</div>
		<?php echo CHtml::beginForm(); ?>

		<?php echo CHtml::errorSummary($model); ?>

		<div class="row">
			<?php echo CHtml::activeLabelEx($model,'username'); ?>
			<?php echo CHtml::activeTextField($model,'username') ?>
		</div>

		<div class="row">
			<?php echo CHtml::activeLabelEx($model,'password'); ?>
			<?php echo CHtml::activePasswordField($model,'password') ?>
			<div class="view-pass"></div>
		</div>


		<div class="row rememberMe checkbox">
			<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
			<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
		</div>

<!--		<div class="row">-->
<!--			<p class="hint">-->
<!--				--><?php ////echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?>
<!--			</p>-->
<!--		</div>-->

		<div class="row submit">
			<?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
			<button type="submit" class="btn"><?php echo UserModule::t("Login"); ?></button>
		</div>

		<?php echo CHtml::endForm(); ?>
	</div><!-- form -->

	<div class="support">
		<a href="">Техподдержка</a>
	</div>


	<?php
	$form = new CForm(array(
		'elements'=>array(
			'username'=>array(
				'type'=>'text',
				'maxlength'=>32,
			),
			'password'=>array(
				'type'=>'password',
				'maxlength'=>32,
			),
			'rememberMe'=>array(
				'type'=>'checkbox',
			)
		),

		'buttons'=>array(
			'login'=>array(
				'type'=>'submit',
				'label'=>'Login',
			),
		),
	), $model);
	?>
</div>
<script>
	$(document).ready(function(){
		$('.view-pass').on('click',function(){
            var $this = $(this);
			var pass = $('#UserLogin_password');

			if(pass.attr('type') == 'password') {
				$('#UserLogin_password').prop('type','text');
                $this.addClass('show');
			}
			else {
				$('#UserLogin_password').prop('type','password');
                $this.removeClass('show');
			}

		});
	});
</script>