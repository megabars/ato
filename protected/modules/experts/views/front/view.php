<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Член экспертного совета';

$this->breadcrumbs = array(
    'Экспертные советы'=>'/experts',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle?></h2>

    <h3><?php echo $model->fio?>, <?php echo Experts::$type_label[$model->type]?></h3>

    <table class="simple-table table-width-75 mt20">
        <tbody>
        <tr>
            <td>Место проживания, контактная информация</td>
            <td><?php echo $model->contact_address?></td>
        </tr>
        <tr>
            <td>Сферы профессиональных интересов</td>
            <td><?php echo $model->skills?></td>
        </tr>
        <tr>
            <td>Образование</td>
            <td><?php echo $model->scientific?></td>
        </tr>
        <tr>
            <td>Опыт работы</td>
            <td><?php echo $model->experience?></td>
        </tr>
        <tr>
            <td>Наличие ученой степени</td>
            <td><?php echo $model->education?></td>
        </tr>
        <tr>
            <td>Ключевые профессиональные компетенции</td>
            <td><?php echo $model->profession_skill?></td>
        </tr>
        <tr>
            <td>История участия в экспертных проектах</td>
            <td><?php echo $model->history?></td>
        </tr>
        <tr>
            <td>Ресурсы в сети</td>
            <td>
                <?php
                if(!empty($model->resources))
                    foreach($model->resources as $resources)
                        echo CHtml::link($resources->url,$resources->url)."<br>";

                ?></td>
        </tr>
        <tr>
            <td>Участие в работе других экспертных организаций и сообществ</td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>