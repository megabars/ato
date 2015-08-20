<?php
/**
 * @var $this Controller
 */

$app = Yii::app();
$assets = $this->assetsBase;
$clientScript = $app->getClientScript();

?>
<!doctype html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=9">

    <link rel="icon" type="image/x-icon" href="<?php echo $assets ?>/images/favicon/favicon.ico" />
    <link rel="icon" type="image/png" href="<?php echo $assets ?>/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $assets ?>/images/favicon/apple-touch-icon-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $assets ?>/images/favicon/apple-touch-icon-57-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $assets ?>/images/favicon/apple-touch-icon-57-precomposed.png">

    <?php
    $clientScript->registerCoreScript('jquery');
    $clientScript->registerCoreScript('jquery.ui');

    $clientScript->registerCssFile($assets . '/css/style.css');
    $clientScript->registerCssFile($assets . '/css/animate.css');

    $clientScript->registerScriptFile($assets . '/js/script.js');
    $clientScript->registerScriptFile($assets . '/js/app.js');

    $clientScript->registerScriptFile($assets . '/js/share.js');
    $clientScript->registerScriptFile($assets . '/js/jquery.fixedtable-modified.js');
    $clientScript->registerScriptFile('http://api-maps.yandex.ru/2.1/?lang=ru_RU');
    ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
</head>

<body class="subportal">
<?php $this->widget('application.extensions.fancybox.EFancyBox', array('helpersEnabled' => true)); ?>

<div id="wrap">
    <div id="main" class="clearfix">

        <div class="header">
            <div class="head">
                <div class="wrap">
                    <div class="portal">
                        <a href="http://tomsk.dpridprod.ru"><?php echo Yii::t('app', 'ПОРТАЛ ИОГВ')?></a>
                    </div>
                    <div class="link">
                        <a href="<?php echo $this->createUrl('/main/siteMap'); ?>" class="header-map"><?php echo Yii::t('app', 'Карта сайта')?></a>
                        <a href="<?php echo $this->createUrl('/feedback/front/index'); ?>" class="header-feedback fancy"><?php echo Yii::t('app', 'Обратная связь')?></a>
                    </div>
                    <div class="lang">
                        <a class="active" href="#">РУС</a>
                        <a href="#">ENG</a>
                        <a href="#">DE</a>
                    </div>
                    <a href="<?php echo $this->createUrl('/main/themes?theme=true'); ?>" class="invalid-style"><?php echo Yii::t('app', 'Версия для слабовидящих')?></a>
                </div>
            </div>
            <div class="wrap">
                <div class="logo">
                    <a href="/"></a>
                    <div class="desc">
                        <div>
                            <span>
                                <?php
                                $portalId = Yii::app()->getController()->portalId;
                                $model = Portal::model()->findByPk($portalId);
                                echo @$model->title
                                ?><br/>
                                <?php echo Yii::t('app', 'Томской области')?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="search">
                    <form action="/search/default/index">
                        <input type="text" placeholder="<?php echo Yii::t('app', 'Поиск'); ?>" name="query" value="<?php echo @$_GET['query']?>" />
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="nav">
            <div class="wrap">
                <?php $this->widget('navigation.widgets.menuByAlias', array(
                    'menu_alias' => 'main_menu',
                    'max_levels' => 1
                )); ?>
            </div>
        </div>


        <?php if(isset($this->breadcrumbs) && $this->breadcrumbs != null):?>
            <div class="breadcrumb">
                <div class="wrap">
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
                        'separator'=>' > ',
                    )); ?>
                </div>
            </div>
        <?php endif?>

        <div class="content">

            <?php if ($app->user->hasFlash('notice')) : ?>
                <div class="alert alert-success">
                    <div class="alert-close"></div>
                    <?php echo $app->user->getFlash('notice'); ?>
                </div>
            <?php endif; ?>

            <?php if ($app->user->hasFlash('error')) : ?>
                <div class="alert alert-error">
                    <div class="alert-close"></div>
                    <?php echo $app->user->getFlash('error'); ?>
                </div>
            <?php endif; ?>

            <?php echo $content; ?>
        </div>

    </div>
</div>

<?php
$this->renderPartial('application.themes.tomsk.views.layouts._footer', array('assets' => $assets));
?>


</body>
</html>
