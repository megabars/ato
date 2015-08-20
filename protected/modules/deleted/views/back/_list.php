<ul>
    <?php foreach($models as $modelName => $model): ?>
        <li>
            <a href="<?php echo Yii::app()->createUrl('/deleted/back/view/', array('name'=>$model, 'title' => $moduleName.": ".$modelName)) ?>">
                <?php echo $modelName; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>