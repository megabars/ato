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
    $clientScript->registerCssFile($assets . '/css/black.css');

    /* Переключение fontsize на версии для слабовидящих */
    if (isset(Yii::app()->session['fontsize'])) {
        switch (Yii::app()->session['fontsize']) {
            case 'small':
                $clientScript->registerCssFile($assets . '/css/fonts-small.css');
                break;
            case 'medium':
                $clientScript->registerCssFile($assets . '/css/fonts-medium.css');
                break;
            case 'big':
                $clientScript->registerCssFile($assets . '/css/fonts-big.css');
                break;
        }
    }

    /* Переключение цветовой схемы на версии для слабовидящих */
    if (isset(Yii::app()->session['themecolor'])) {
        switch (Yii::app()->session['themecolor']) {
            case 'black':
                $clientScript->registerCssFile($assets . '/css/color-black.css');
                break;
            case 'blue':
                $clientScript->registerCssFile($assets . '/css/color-blue.css');
                break;
        }
    }

    $clientScript->registerScriptFile('http://api-maps.yandex.ru/2.1/?lang=ru_RU');
    $clientScript->registerScriptFile($assets . '/js/script.js');
    $clientScript->registerScriptFile($assets . '/js/app.js');

    $clientScript->registerScriptFile($assets . '/js/share.js');
    ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
</head>

<body class="subportal subportal-expert page-invalid-version">

<div id="wrap">
    <div id="main" class="clearfix">
        <div class="header">
            <div class="head">
                <div class="wrap">
                    <div class="theme-settings">
                        <div class="theme-settings-fonts">
                            Шрифт
                            <a href="<?php echo $this->createUrl('/main/fonts?fontsize=small') ?>" class="font-small<?php echo Yii::app()->session['fontsize'] == "small" ? " active" : "" ?>">а</a>
                            <a href="<?php echo $this->createUrl('/main/fonts?fontsize=medium') ?>" class="font-medium<?php echo Yii::app()->session['fontsize'] == "medium" ? " active" : "" ?>">а</a>
                            <a href="<?php echo $this->createUrl('/main/fonts?fontsize=big') ?>" class="font-big<?php echo Yii::app()->session['fontsize'] == "big" ? " active" : "" ?>">а</a>
                        </div>
                        <div class="theme-settings-color">
                            Цвет сайта
                            <a href="<?php echo $this->createUrl('/main/color?themecolor=white') ?>" class="color-white<?php echo Yii::app()->session['themecolor'] == "white" ? " active" : "" ?>">аб</a>
                            <a href="<?php echo $this->createUrl('/main/color?themecolor=black') ?>" class="color-black<?php echo Yii::app()->session['themecolor'] == "black" ? " active" : "" ?>">аб</a>
                            <a href="<?php echo $this->createUrl('/main/color?themecolor=blue') ?>" class="color-blue<?php echo Yii::app()->session['themecolor'] == "blue" ? " active" : "" ?>">аб</a>
                        </div>
                    </div>
                    <div class="link">
                        <a href="<?php echo $this->createUrl('/main/siteMap'); ?>" class="header-map">Карта сайта</a>
                        <a href="<?php echo $this->createUrl('/feedback/front/index'); ?>" class="header-feedback fancy">Обратная связь</a>
                        <a href="tomsk.dpridprod.ru">Портал ИОГВ</a>
                    </div>
                    <a  href="#" class="invalid-style">Версия для слабовидящих</a>
                </div>
            </div>
            <div class="wrap">
                <div class="logo">
                    <a href="/"></a>
                    <div class="desc">
                        <div>
                            <span>Экспертный Совет по социальной политике</span>
                            при заместителях Губернатора Томской области
                        </div>
                    </div>
                </div>

                <div class="search">
                    <form action="">
                        <input type="text" placeholder="Поиск"/>
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="nav">
            <div class="wrap">
                <?php $this->widget('navigation.widgets.menuByAlias'); ?>
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

<div class="footer">
    <div class="wrap">
        <div class="right">
            <div class="social">
                <div class="label">Социальные сети:</div>
                <!--                <a href="" target="_blank" class="social-vk"></a>-->
                <a href="https://twitter.com/TomskRegion" target="_blank" class="social-tw"></a>
                <a href="https://www.facebook.com/TomskayaOblast" target="_blank" class="social-fb"></a>
            </div>
            <div class="link">
                <a href="<?php echo $this->createUrl('/main/siteMap'); ?>" class="footer-map">Карта сайта</a>
                <a href="<?php echo $this->createUrl('/feedback/front/index'); ?>" class="footer-feedback fancy">Обратная связь</a>
            </div>
            <div class="copyright">&nbsp;</div>
        </div>
        <div class="left">
            <div class="title">Контактная информация</div>
            <div class="desc">
                <p>Администрация Томской области</p>
                <p>Адрес: 634050, г.Томск, пл. Ленина, 6</p>
                <p>Тел: <a href="tel: +73822510505">+7 (382-2) 510-505</a>, <a href="tel: +73822510001">+7 (382-2) 510-001</a></p>
                <p>Факс: <a href="tel: +73822510730">+7 (382-2) 510-730</a>,</p>
                <p>Электронная почта: <a href="mailto:ato@tomsk.gov.ru"><b>ato@tomsk.gov.ru</b></a></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
