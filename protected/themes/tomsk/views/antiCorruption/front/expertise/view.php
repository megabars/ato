<?php
/**
 * @var $this FrontController
 * @var $model AcExpertise
 */

$this->breadcrumbs = array(
    'Противодействие коррупции',
    'Независимая антикоррупциионная экспертиза'=>'/antiCorruption/front/expertise',
    $model->title
);
?>

<div class="wrap">

    <div class="clearfix">
        <div class="right-content">
            <div class="docs-info">
                <div class="title">
                    <h5>Исполнительный орган государственной власти:</h5>
                    <div>
                        <?php $executive_name = ($model->executive_id > 0) ? $model->executive->name : "Администрация Томской области";
                        $executive = Contact::model()->findByAttributes(array('executive_id'=>$model->executive_id));

                        echo '<b>'.$executive_name.'</b>';

                        if (isset($executive->address)) {
                            echo '<p>'.$executive->address.'</p>';
                        }

                        if (isset($executive->phone) && is_array($executive->phone)) {
                            echo '<p>Тел: ';
                            foreach($executive->phone as $phone)
                                echo '<a href="tel:'. $phone->value.'">'.$phone->value.'</a>, ';
                            echo '</p>';
                        }

                        if (isset($executive->fax) && is_array($executive->fax)) {
                            echo '<p>Факс: ';
                            foreach($executive->fax as $fax)
                                echo '<a href="tel:'. $fax->value.'">'.$fax->value.'</a>, ';
                            echo '</p>';
                        }

                        if (isset($executive->email) && is_array($executive->email)) {
                            echo '<p>E-mail: ';
                            foreach($executive->email as $email)
                                echo '<a href="mailto:'. $email->value.'">'.$email->value.'</a>, ';
                            echo '</p>';
                        }?>
                    </div>
                </div>

                <div class="date-docs">
                    <b>Начало:</b>
                    <?php echo date('d.m.Y',$model->date_start); ?>
                    <b>Окончание:</b>
                    <?php echo date('d.m.Y',$model->date_finish); ?>
                    <b>Размещено:</b>
                    <?php echo date('d.m.Y',$model->date_publish); ?>
                </div>

                <?php if ($model->file) : ?>
                    <div class="link-docs">
                        <b>Скачать документ:</b>
                        <div><a href="<?php echo $model->getFileUrl($model->file); ?>"><?php echo $model->originFile->ext; ?> (<?php echo File::getFileSize($model->file, 'Mb'); ?>)</a></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="left-content">
            <h2><?php echo $model->title; ?></h2>
            <div class="custom-content">
                <?php echo $model->description; ?>
            </div>
        </div>
    </div>
</div>