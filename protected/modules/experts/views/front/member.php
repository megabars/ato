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

    <h3>Список участников</h3>


    <div class="clearfix">
        <div class="people clearfix">
            <div class="left">
                <div class="image">
                    <img src="<?php echo $assets; ?>/images/guber.png"/>
                </div>
                <div class="name">Рябчиков Вазиль Устакоанович</div>
                <div class="post">Председатель Экспертного совета</div>

                <ul>
                    <li>
                        <b>Адрес:</b> 634050, Томская область, г. Томск, пл. Ленина, 6
                    </li>
                    <li>
                        <b>Телефон:</b> (3822) 510-505
                    </li>
                    <li>
                        <b>Факс:</b> (3822) 510-730
                    </li>
                    <li>
                        <b>Сайт:</b> <a href="">gubernator.tomsk.ru</a>
                    </li>
                </ul>
            </div>

            <div class="right">
                <ul class="people-list">
                    <li>
                        <a href="/experts/memberId" class="image">
                            <img src="<?php echo $assets; ?>/images/img.png"/>
                        </a>

                        <div class="desc">
                            <a class="name" href="/experts/memberId">Левин Сергей Владимирович</a>
                            <div class="post">Секретарь приемной Губернатора Томской области </div>

                            <ul>
                                <li><b>Телефон:</b> (3822) 510-505, (3822) 510-508</li>
                                <li><b>Email:</b> levin@tomsk.gov.ru</li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/experts/memberId" class="image">
                            <img src="<?php echo $assets; ?>/images/img.png"/>
                        </a>

                        <div class="desc">
                            <a class="name" href="/experts/memberId">Левин Сергей Владимирович</a>
                            <div class="post">Секретарь приемной Губернатора Томской области </div>

                            <ul>
                                <li><b>Телефон:</b> (3822) 510-505, (3822) 510-508</li>
                                <li><b>Email:</b> levin@tomsk.gov.ru</li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/experts/memberId" class="image">
                            <img src="<?php echo $assets; ?>/images/img.png"/>
                        </a>

                        <div class="desc">
                            <a class="name" href="/experts/memberId">Левин Сергей Владимирович</a>
                            <div class="post">Секретарь приемной Губернатора Томской области </div>

                            <ul>
                                <li><b>Телефон:</b> (3822) 510-505, (3822) 510-508</li>
                                <li><b>Email:</b> levin@tomsk.gov.ru</li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/experts/memberId" class="image">
                            <img src="<?php echo $assets; ?>/images/img.png"/>
                        </a>

                        <div class="desc">
                            <a class="name" href="/experts/memberId">Левин Сергей Владимирович</a>
                            <div class="post">Секретарь приемной Губернатора Томской области </div>

                            <ul>
                                <li><b>Телефон:</b> (3822) 510-505, (3822) 510-508</li>
                                <li><b>Email:</b> levin@tomsk.gov.ru</li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/experts/memberId" class="image">
                            <img src="<?php echo $assets; ?>/images/img.png"/>
                        </a>

                        <div class="desc">
                            <a class="name" href="/experts/memberId">Левин Сергей Владимирович</a>
                            <div class="post">Секретарь приемной Губернатора Томской области </div>

                            <ul>
                                <li><b>Телефон:</b> (3822) 510-505, (3822) 510-508</li>
                                <li><b>Email:</b> levin@tomsk.gov.ru</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
