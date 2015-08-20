<?php
/** @var $this Controller */

$assets = $this->getAssetsBase();

$this->pageTitle = Yii::t('app', 'Карта сайта');

$this->breadcrumbs = array(
    $this->pageTitle
);



?>
<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>

    <div class="site_map">
        <?php $this->widget('navigation.widgets.menuByAlias', array(
            'menu_alias' => 'main_menu',
        )); ?>
    </div>
</div>
<style type="text/css">
    .site_map ul {
        padding-left: 20px;
    }
    .site_map ul li {
        margin-top: 10px;
        position: relative;
    }
    .site_map ul li:before {
        position: absolute;
        left: -1em;
    }
    .site_map>ul>li {
        list-style: disc;
        font-weight: 700;
    }
    .site_map>ul>li li {
        margin-left: 25px;
    }
    .site_map>ul>li>ul>li {
        list-style: square;
        font-weight: 300;
    }
    .site_map>ul>li>ul>li>ul>li {
        list-style: circle;
    }
    .site_map>ul>li>ul>li>ul>li>ul>li:before {
        content: '\2014';
    }
    .site_map>ul>li>ul>li>ul>li>ul>li>ul>li:before {
        content: '\25CA';
    }

</style>