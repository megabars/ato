<?php
/** @var Controller $this */

$app = Yii::app();
$assets = $this->getAssetsBase();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link href="<?php echo $assets; ?>/images/favicon.ico" rel="shortcut icon" sizes="16x16 32x32" type="image/x-icon"/>

    <?php
    $script = $app->getClientScript();
    $script->registerCssFile($assets . '/css/login.css');
    $script->registerCoreScript('jquery');
    ?>
    <title><?php echo Yii::app()->name . ' - ' . $this->pageTitle; ?></title>
</head>

<body>

<?php echo $content; ?>

<?php if ($app->user->hasFlash('notice')) : ?>
    <div class="alert alert-success">
        <div class="close"></div>
        <?php echo $app->user->getFlash('notice'); ?>
    </div>
<?php endif; ?>
<?php if ($app->user->hasFlash('error')) : ?>
    <div class="alert alert-error">
        <div class="close"></div>
        <?php echo $app->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
</body>
</html>