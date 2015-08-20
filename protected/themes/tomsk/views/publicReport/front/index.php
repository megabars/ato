<?php
/**
 * @var $this Controller
 * @var $form1 PublicReport
 * @var $form2 PublicReport
 * @var $archive PublicReport
 */

$this->pageTitle = 'Формы публичной отчетности';

$this->breadcrumbs = array(
    $this->pageTitle
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle?></h2>

    <ul>
        <li>1. <a href="<?php echo $form1->getFileUrl($form1->file); ?>">Форма 1 по состоянию на <?php echo $form1->date; ?></a> </li>
        <li>2. <a href="<?php echo $form2->getFileUrl($form2->file); ?>">Форма 2 по состоянию на <?php echo $form2->date; ?></a> </li>
    </ul>

    <?php if(isset($archive)): ?>
        <div class="collapses mt30">
            <div class="item">
                <div class="title">
                    <div class="name">Архив</div>
                    <div class="toggle"></div>
                </div>
                <div class="desc">
                    <div class="files">
                        <?php foreach($archive as $item): ?>
                        <div class="item">
                            <a href="<?php echo $item->getFileUrl($item->file); ?>" >Форма <?php echo $item->type; ?> по состоянию на <?php echo $item->date; ?></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>


</div>