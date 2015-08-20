<?php
/** @var $this BackController */

$this->pageTitle = 'Дополнительно';

$this->breadcrumbs = array(
    'Обращения граждан' => '/appeal/back',
    $this->pageTitle
);
?>

<div class="page-header">
    <h2><?php echo $this->pageTitle; ?></h2>
</div>

<div class="list-group" style="margin: 10px 0;">
    <a class="btn" href="<?php echo $this->createUrl('/pages/back/NavItem', array('itemId' => $this->staticPage->id))?>">Общая информация</a>
    <a class="btn" href="<?php echo $this->createUrl('/pages/back/NavItem', array('itemId' => $this->staticPage->id))?>">Нормативные документы</a>
</div>
