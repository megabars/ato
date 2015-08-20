<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */

$label = $this->pluralize($this->class2name($this->modelClass));
$modelClass = $this->getModelClass();
?>

<?php
echo "<?php\n";
echo "/** @var \$model " . $this->getModelClass() . " */\n";
echo "/** @var \$this " . $this->getControllerClass() . " */\n\n";
echo "\$this->breadcrumbs = array(
	'$label',
);\n";
?>
?>

<div class="page-header">
    <h2><?php echo $modelClass; ?></h2>
</div>

<div class="list-group">
    <a class="btn btn-default btn-sm icons remove-all"
       href="<?php echo "<?php"; ?> echo $this->createUrl('/admin/<?php echo strtolower($modelClass); ?>/deleteAll'); ?>">
        Удаление
    </a>

    <a class="btn btn-sm icons white add-new fr"
       href="<?php echo "<?php"; ?> echo $this->createUrl('/admin/<?php echo strtolower($modelClass); ?>/create'); ?>">
        Добавить <?php echo "{$modelClass}\n"; ?>
    </a>
</div>

<?php echo "<?php\n"; ?>
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => false,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}',
            'buttons' => array(
                'view' => array(
                    'url' => 'Yii::app()->createUrl("/<?php echo strtolower($modelClass); ?>/view", array("id" => $data->id))',
                    'options' => array("target" => "_blank"),
                ),
            ),
        ),
    ),
));