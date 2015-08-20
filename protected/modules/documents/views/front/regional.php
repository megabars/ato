<?php
/**
// * @var $this Controller
 * @var $records DocumentsFolder[]
 */

$this->pageTitle = 'Региональное развитие';

//$this->breadcrumbs = array(
//    'Документы'=>'/documents',
//    'Региональное развитие'
//);
?>

<div class="wrap">
    <h2>Стратегическое планирование
        на региональном уровне</h2>

    <div class="clearfix">
        <div class="right-content">
            <div class="right-menu">
                <?php $this->widget('navigation.widgets.menuByAlias', array(
                    'parentId' => $this->navigationItemId,
                    'menu_alias' => 'main_menu',
                    'max_levels' => 0
                )); ?>
            </div>
        </div>
        <div class="left-content">

            <div class="mt20">
                <div class="links-table">
                    <div class="head">Региональное развитие</div>
                    <ol>
                        <li><a href="#">Стратегическое планирование на федеральном уровне</a></li>
                        <li><a href="/documents/front/strategy_regional?menuItem=1637">Стратегическое планирование на региональном уровне</a></li>
                        <li><a href="#">Стратегическое планирование на муниципальном уровне</a></li>
                        <li><a href="#">Исполнение "майских" указов Президента РФ</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>