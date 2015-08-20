<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<div class="login">
    <div class="form">
        <?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
            <div class="head"><?php echo UserModule::t("Restore"); ?></div>
            <div style="padding: 15px;">
                <div><?php echo Yii::app()->user->getFlash('recoveryMessage'); ?></div>
                <a href="<?php echo $this->createUrl('/user/login'); ?>" class="btn" style="margin-top: 20px;">Войти</a>
            </div>
        <?php else: ?>


        <div class="head"><?php echo UserModule::t("Restore"); ?></div>
        <?php echo CHtml::beginForm(); ?>

            <?php echo CHtml::errorSummary($form); ?>

            <div class="row">
                <?php echo CHtml::activeLabel($form,'login_or_email'); ?>
                <?php echo CHtml::activeTextField($form,'login_or_email') ?>
                <p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
            </div>

            <div class="row submit">
                <button class="btn" type="submit"><?php echo UserModule::t("Restore"); ?></button>
            </div>

        <?php echo CHtml::endForm(); ?>
    </div><!-- form -->
<?php endif; ?>
</div>