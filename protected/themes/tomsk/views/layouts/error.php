<?php
/**
 * @var $this Controller
 */

$app = Yii::app();
$assets = $this->assetsBase;
$clientScript = $app->getClientScript();

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" href="<?php echo $assets ?>/css/errors.css"/>
</head>
<body>

<?php echo $content; ?>

</body>
</html>