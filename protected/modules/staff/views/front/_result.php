<?php
/** @var $model Staff */
?>

<?php if ($model->result || $model->result_file) : ?>
    <li>
        <div class="label">Результаты</div>
        <div class="desc">
            <?php echo $model->result; ?>

            <?php if ($model->result_file) : ?>
                <div>
                    <a href="<?php echo File::getFileUrl($model->result_file); ?>">
                        Файл с результатами
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </li>
<?php endif; ?>