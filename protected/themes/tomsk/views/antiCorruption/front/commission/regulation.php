<?php
/**
 * @var $this FrontController
 * @var $commission AcCommission
 */
$this->pageTitle = 'Положение';

$this->breadcrumbs = array(
    'Противодействие коррупции',
    'Комиссия Администрации Томской области по соблюдению требований к служебному поведению'=>'/antiCorruption/front/commission',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Положение</h2>
    <div class="clearfix">

        <?php $this->renderPartial('commission/_menu'); ?>

        <div class="left-content">
            <div class="custom-content">
                <?php if(isset($commission->regulation)): ?>
                <?php echo $commission->regulation; ?>
                <?php else: ?>
                    Запись не создана
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

