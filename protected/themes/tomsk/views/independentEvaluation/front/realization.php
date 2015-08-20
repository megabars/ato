<?php
/**
 * @var $this FrontController
 * @var $groups PortalGroup
 */
$this->pageTitle = 'Реализация независимой оценки в Томской области';

$this->breadcrumbs = array(
    'Независимая оценка'=>'/nezavisimaya_otsenka',
    $this->pageTitle
);
?>

<div class="wrap invalid-version">
    <h2><?php echo $this->pageTitle; ?></h2>
    <div class="clearfix">

        <?php $this->renderPartial('_menu'); ?>

        <div class="left-content">
                <div class="collapses mt30">
                    <?php foreach ($groups as $group): ?>
                        <div class="item">
                            <div class="title">
                                <div class="name"><?php echo $group->name; ?></div>
                                <div class="toggle"></div>
                            </div>
                            <div class="desc">
                                <?php foreach ($group->evaluations as $evaluation): ?>
                                    <div><a href="<?php echo $evaluation->link; ?>"><?php echo $evaluation->executive->name; ?></a></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </div>
</div>