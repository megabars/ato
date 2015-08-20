<?php

$label = $this->pluralize($this->class2name($this->modelClass));
$modelClass = $this->getModelClass();
$controllerClass = $this->getControllerClass();

echo "<?php\n";
echo "/** @var \$model " . $modelClass . " */\n";
echo "/** @var \$this " . $controllerClass . " */\n\n";
echo "\$this->breadcrumbs = array(
	'$label' => array('" . strtolower($modelClass) . "/index'),
	'Редактирование " . $modelClass . "',
);\n";
?>
?>

<div class="page-header">
    <h2>Редактирование <?php echo $modelClass; ?></h2>
</div>

<?php echo "<?php echo \$this->renderPartial('_form', array('model' => \$model));"; ?>
