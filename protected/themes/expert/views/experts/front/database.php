<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Методические материалы';

$this->breadcrumbs = array(
    'Экспертные советы'=>'/experts',
    'Наименование совета'
);
?>

<div class="wrap">
    <h2>Наименование совета</h2>

    <a class="btn fr" href="/experts/register">Зарегестрироваться как эксперт</a>
    <h3>База данных экспертов</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Тип</th>
                <th>ФИО</th>
                <th class="last">Наименование экспертного совета</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($model))
            foreach($model as $m){?>

                <tr>
                    <td><?php echo Experts::$type_label[$m->type]?></td>
                    <td><a href="/experts/database_view/<?php echo $m->id?>"><?php echo $m->fio?></a></td>
                    <td><?php echo Experts::$sovet[$m->sovet_id]?></td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>