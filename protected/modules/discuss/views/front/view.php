<?php
/**
 * @var $this Controller
 * @var $model Discuss
 */
$this->pageTitle = 'Обсуждение законопроектов';

$this->breadcrumbs = array(
    'Открытый Регион' => '/Otkritiy-region',
    'Обсуждение законопроектов' => $this->createUrl('/discuss/front'),
    $model->title
);
?>

<div class="wrap">
    <h2><?php echo $model->title; ?></h2>

    <div class="custom-content">
        <?php echo $model->description; ?>
    </div>

    <div class="files-list">
        <ul>
            <li>
                <?php if(isset($model->file)):

                echo CHtml::link($file->origin_name, File::model()->getFileUrl($file->id),
                    array('target' => '_blank', 'class' => 'file file-pdf', 'title' => $file->origin_name)); ?>

                (<?php echo $file->getFileSize($file->id, 'Kb'); ?>)

                <?php endif; ?>
            </li>
        </ul>
    </div>

    <?php $this->widget('comments.widgets.ECommentsListWidget', array('model' => $model)); ?>
    <br/>

    <?php
    if ($model->date_finish > time())
        $this->widget('comments.widgets.ECommentsFormWidget', array('model' => $model));
    ?>

    <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
    <br/>
</div>

