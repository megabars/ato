<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;

$this->breadcrumbs = array(
    'Открытый регион' => $this->createUrl('/Otkritiy-region'),
    'Конкурсы' => $this->createUrl('/contests/front'),
);
if($model->state == Contest::STATUS_OPENED) {
    $this->breadcrumbs['Открытые конкурсы'] = $this->createUrl('/contests/front/index');
} elseif($model->state == Contest::STATUS_CLOSED) {
    $this->breadcrumbs['Итоги конкурсов'] = $this->createUrl('/contests/front/results');
} elseif ($model->state == Contest::STATUS_ARCHIVED) {
    $this->breadcrumbs['Архив конкурсов'] = $this->createUrl('/contests/front/archive');
}

$this->breadcrumbs[] = $model->title
?>

<div class="wrap">
    <h2><?php echo CHtml::encode($model->title) ?></h2>

    <div class="highlight-content">
        <h3>Организатор конкурса</h3>
        <p><?php echo CHtml::encode($model->org) ?></p>
    </div>

    <div class="custom-content">
        <?php echo $model->description ?>
    </div>
</div>