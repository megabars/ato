<?php
/**
 * @var $this Controller
 * @var $model AppealReview
 * @var $years CHtml::listData
 */
$this->pageTitle = 'Обзор обращений';

$this->breadcrumbs = array(
    'Открытый Регион',
    'Обращения',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Обращения граждан</h2>
    <h3><?php echo $this->pageTitle; ?></h3>

    <div class="clearfix">
        <?php $this->renderPartial('_menu') ?>

        <div class="left-content">
            <div class="select-filter">
                <div class="horisontal-row">
                    <div class="label">Выбрать год</div>
                    <?php echo CHtml::dropDownList('year', @$model->id,  @$years, array('id'=>'year')); ?>
                </div>
            </div>
            <?php echo $model->description; ?>

            <?php if(isset($model->file_id)): ?>
                <div class="collapses mt30">
                    <div class="item">
                        <div class="title">
                            <div class="name">Скачать документ</div>
                            <div class="toggle"></div>
                        </div>
                        <div class="desc">
                            <div class="files">
                                <div class="item">
                                    <a href="<?php echo $model->getFileUrl($model->file_id); ?>" ><?php
                                        $file = File::model()->findByPk($model->file_id);

                                        if ($file !== null)
                                            echo $file->origin_name;

                                        ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#year').on('change', function() {window.location.replace('/appeal/front/review/id/' + this.value);})
</script>