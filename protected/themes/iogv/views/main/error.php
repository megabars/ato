<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Ошибка';
$this->breadcrumbs = array(
    'Ошибка',
);
?>

<div class="errors">
<!--    --><?php //echo $code; ?>
</div>
<div class="message">
    <div class="head">Запрашиваема страница в процессе наполнения</div>
    <!--    <div class="head">--><?php //echo (!empty($message)) ? $message : 'Запрашиваемый адрес недоступен'?><!--</div>-->
    <!--    <div class="boot">ПРОСИМ ПРОЩЕНИЯ, НО НА ПОРТАЛЕ ВЕДУТСЯ ТЕХНИЧЕСКИЕ РАБОТЫ</div>-->
</div>

<?php if (YII_DEBUG): ?>
    <div class="error-code" style="display: none">
        <?php
        echo $file . ' at line ' . $line;
        ?>
        <pre>
<?php
echo $trace;
?>
</pre>

    </div>
<?php endif; ?>

</div>
