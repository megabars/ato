<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Регистрация эксперта';

$this->breadcrumbs = array(
    'Экспертные советы'=>'/experts',
    'Список участников'
);
?>

<div class="wrap">
    <h2>Наименование совета</h2>

    <h3>Председатель Экспертного совета</h3>

    <div class="clearfix">
        <div class="people clearfix">
            <div class="left">
                <div class="image">
                    <img src="<?php echo $assets; ?>/images/guber.png"/>
                </div>
            </div>

            <div class="right">
                <h3>Рябчиков Вазиль Устакоанович</h3>
                <ul>
                    <li>
                        <b>Телефон:</b> (3822) 510-505
                    </li>
                    <li>
                        <b>Email:</b> <a href="mailto:levin@tomsk.gov.ru">levin@tomsk.gov.ru</a>
                    </li>
                </ul>

                <div class="people-info">
                    <h4>Биография</h4>
                    <div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                        </p>
                    </div>
                    <h4>Резюме</h4>
                    <div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
