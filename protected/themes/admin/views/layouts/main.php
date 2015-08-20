<?php
/** @var Controller $this */

$app = Yii::app();
$assets = $this->getAssetsBase();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="<?php echo $assets; ?>/images/favicon.ico" rel="shortcut icon" sizes="16x16 32x32" type="image/x-icon"/>

    <?php
    $script = $app->getClientScript();

    $script->registerCssFile($assets . '/css/admin.css');
    //$script->registerCssFile($assets . '/css/screen.css');
    //$script->registerCssFile($assets . '/css/main.css');
    //$script->registerCssFile($assets . '/css/form.css');
    //$script->registerCssFile($assets . '/css/style.css');
    //$script->registerCssFile($assets . '/css/font-awesome.css');
    //$script->registerCssFile($assets . '/css/jquery-ui1.css');
    //$script->registerCssFile($assets . '/css/jquery-ui-1.9.2.custom.css');

    $script->registerCoreScript('jquery');
    $script->registerCoreScript('jquery.ui');
    $script->registerScriptFile($assets . '/js/ckeditor/ckeditor.js');
    $script->registerScriptFile($assets . '/js/ckfinder/ckfinder.js');
    $script->registerScriptFile($assets . '/js/jquery.synctranslit.js');

    $script->registerScriptFile($assets . '/js/tabs.js');
    $script->registerScriptFile($assets . '/js/icheck.min.js');
    $script->registerScriptFile($assets . '/js/jquery.jscrollpane.min.js');
    $script->registerScriptFile($assets . '/js/jquery.mousewheel.js');
    $script->registerScriptFile($assets . '/js/mwheelIntent.js');
    $script->registerScriptFile($assets . '/js/chosen.jquery.min.js');
    $script->registerScriptFile($assets . '/js/main.js');
    $script->registerScriptFile($assets . '/js/admin.js');
    ?>

    <script type="text/javascript">var jsPath = '<?php echo $assets ?>/js';</script>

    <title><?php echo Yii::app()->name . ' - ' . $this->pageTitle; ?></title>
</head>

<body>
<header>
    <a href="/admin" class="bars-cms">Административная панель</a>
    <div class="search">
<!--        <div class="dropdown fl">-->
<!--            <div class="btn icon icon-plus">Добавить</div>-->
<!--            <div class="dropdown-list">-->
<!--                <ul>-->
<!--                    <li><a href="--><?php //echo Yii::app()->createUrl('/news/back/create'); ?><!--">Новость</a></li>-->
<!--                    <li><a href="--><?php //echo Yii::app()->createUrl('/smi/back/create'); ?><!--">Публикацию СМИ</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--        <form action="">-->
<!--            <input type="text" placeholder="Поиск ...">-->
<!--            <button type="submit"></button>-->
<!--        </form>-->
    </div>
    <div class="users">
        <div class="username"><?php echo Yii::app()->user->name; ?></div>
        <a href="<?php echo Yii::app()->createUrl('/user/logout'); ?>"></a>
    </div>
</header>

<nav>

    <a target="_blank" href="/" class="current-site"> <span><?php echo $_SERVER['HTTP_HOST'] ?></span> </a>

    <div class="scroll-pane">
        <?php

        $portal = Portal::model()->findByPk($this->portalId);

        if ($portal->theme == 'tomsk')
        {
            if ($this->visibleNavigationElement('other'))
            {
                $items = array(
                    array(
                        'label' => 'Рабочий стол',
                        'url' => array('/admin/main/index'),
                        'itemOptions' => array('class' => 'icon icon-home'),
                    ),

                    array('label' => 'Контент',
                        'itemOptions' => array('class' => 'icon icon-content dropdown-toggle'),
                        'items' => array(
                            array('label' => 'Статические страницы',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                )),
                            array('label' => 'Пресс центр',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'События региона', 'url' => array('/pages/back/index', 'type' => '1')),
                                    array('label' => 'Новости', 'url' => array('/news/back/index'), 'active' => in_array($this->route,array('news/back/index','news/back/create','news/back/update','news/subscribers/index','news/type/index'))),
                                    array('label' => 'Томская область в СМИ', 'url' => array('/smi/back/index'), 'active' => in_array($this->route,array('smi/back/index','smi/back/create','smi/back/update',))),
                                    array('label' => 'Календарь мероприятий', 'url' => array('/afisha/back/index'), 'active' => in_array($this->route,array('afisha/back/index','afisha/back/create','afisha/back/update','afisha/back/settings',))),
                                    array('label' => 'Стенограммы', 'url' => array('/pages/back/index', 'type' => '3')),
                                )),

                            array(
                                'label' => 'Открытый регион',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array(
                                        'label' => 'Обращения граждан',
                                        'itemOptions' => array('class' => 'dropdown-toggle'),
                                        'items' => array(
                                            array('label' => 'Общая информация', 'url' => array('/appeal/back/index', 'page' => 'main_info')),
//                                        array('label' => 'График приема граждан', 'url' => array('/appeal/schedule/index')),
                                            array('label' => 'Место, время и порядок приема', 'url' => array('/appeal/place/index')),
                                            array('label' => 'Обзор обращений', 'url' => array('/appeal/review/index')),
                                        )
                                    ),
                                    array(
                                        'label' => 'Независимая оценка',
                                        'itemOptions' => array('class' => 'dropdown-toggle'),
                                        'items' => array(
                                            array('label' => 'Правовые основания проведения независимой оценки', 'url' => array('/independentEvaluation/reason/index')),
                                            array('label' => 'Методические рекомендации', 'url' => array('/independentEvaluation/recommendation/index')),
                                            array('label' => 'Организационное обеспечение', 'url' => array('/independentEvaluation/support/index')),
                                            array('label' => 'Реализация независимой оценки в Томской области', 'url' => array('/independentEvaluation/realization/index')),
                                            array('label' => 'Результаты проведения независимой оценки', 'url' => array('/independentEvaluation/result/index')),
                                        )
                                    ),
                                    array('label' => 'Открытые данные', 'url' => array('/opendata/back/index'), 'active' => in_array($this->route,array('opendata/back/index','opendata/back/create','opendata/back/update','opendata/back/settings','opendata/version/index',))),
                                    array('label' => 'Обсуждения законопроектов', 'url' => array('/discuss/back/index'), 'active' => in_array($this->route,array('discuss/back/index','discuss/back/create','discuss/back/update','comments/comment/admin'))),
                                    array('label' => 'Оценка регулирующего воздействия', 'url' => array('/rating/back/index'), 'active' => in_array($this->route,array('rating/back/index','rating/back/create','discuss/back/update',))),
                                    array('label' => 'Опросы', 'url' => array('/vote/back/index'), 'active' => in_array($this->route,array('vote/back/index','vote/back/create','vote/back/update',))),
                                    array('label' => 'Конкурсы', 'url' => array('/contests/back/index'), 'active' => in_array($this->route,array('contests/back/index','contests/back/create','contests/back/update',))),
                                )
                            ),

                            array('label' => 'Информационные системы, банки данных, реестры, регистры', 'url' => array('/systems/back/index'), 'active' => in_array($this->route, array('systems/back/index', 'systems/back/create'))),
                            array('label' => 'Формы обращений и заявлений', 'url' => array('/forms/back/index'), 'active' => in_array($this->route, array('forms/back/index', 'forms/back/create'))),
                            array('label' => 'Нормативно-правовые акты', 'url' => array('/documents/back/index'), 'active' => in_array($this->route,array('documents/back/index', 'documents/npa/index')) && !isset($_GET['alias'])),
                            array('label' => 'Проекты НПА', 'url' => array('/npa/back/index'), 'active' => in_array($this->route, array('npa/back/index', 'npa/back/create')) && !isset($_GET['alias'])),
                            array('label' => 'Административные регламенты', 'url' => array('/regulations/back/index'), 'active' => in_array($this->route,array('regulations/back/index','regulations/back/create','regulations/back/update')) && !isset($_GET['alias'])),
                            array('label' => 'Кадровая политика', 'url' => array('/staff/back/index'), 'active' => in_array($this->route,array('staff/back/index','staff/back/create','staff/back/update',))),
                            array(
                                'label' => 'Противодействие коррупции',
                                //'url' => Yii::app()->createUrl('/antiCorruption/back'),
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'Нормативно-правовые акты', 'url' => array('/antiCorruption/document/index')),
                                    array('label' => 'Независимая антикоррупциионная экспертиза', 'url' => array('/antiCorruption/expertise/index')),
                                    array('label' => 'Методические материалы', 'url' => array('/antiCorruption/methodical/index')),
                                    array('label' => 'Формы справок о доходах и расходах', 'url' => array('/antiCorruption/certificate/index')),
                                    array('label' => 'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера', 'url' => array('/antiCorruption/public/index')),
                                    array(
                                        'label' => 'Комиссия Администрации Томской области по соблюдению требований к служебному поведению',
                                        //'url' => Yii::app()->createUrl('/antiCorruption/commission'),
                                        'itemOptions' => array('class' => 'dropdown-toggle'),
                                        'items' => array(
                                            array('label' => 'Состав комиссии', 'url' => array('/antiCorruption/members/index')),
                                            array('label' => 'Положение', 'url' => array('/antiCorruption/situation/index')),
                                            array('label' => 'План работы', 'url' => array('/antiCorruption/schedule/index')),
                                            array('label' => 'Материалы заседаний', 'url' => array('/antiCorruption/meeting/index')),
                                            array('label' => 'Информационные материалы', 'url' => array('/antiCorruption/info/index')),
                                            array('label' => 'Формы обращений', 'url' => array('/antiCorruption/appeal/index')),
                                        )
                                    ),
                                )
                            ),
                            array('label' => 'Органы власти',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'Персоналии', 'url' => array('/people/back/index'), 'active' => in_array($this->route,array('people/back/index','people/back/create','people/back/update','people/peopleUnit/index','people/peopleStaff/index','people/back/life'))),
                                    array('label' => 'Ведомства', 'url' => array('/people/office/index'), 'active' => in_array($this->route,array('people/office/index','people/office/create','people/office/update','people/back/life'))),
                                    array('label' => 'Судебная власть', 'url' => array('/people/law/index'), 'active' => in_array($this->route,array('people/law/index','people/law/create','people/law/update','people/back/life'))),
                                    array('label' => 'Главы органов местного самоуправления', 'url' => array('/people/iogv/index'), 'active' => in_array($this->route,array('people/iogv/index','people/iogv/create','people/iogv/update','people/back/life'))),
                                    array('label' => 'Территориальные органы федеральных органов власти', 'url' => array('/people/terr/index'), 'active' => in_array($this->route,array('people/terr/index','people/terr/create','people/terr/update','people/back/life'))),
                                    array('label' => 'Органы власти', 'url' => array('/people/power/index'), 'active' => in_array($this->route,array('people/power/index','people/power/create','people/power/update','people/power/life'))),
                                    array('label' => 'Иные органы власти', 'url' => array('/people/otherPower/index'), 'active' => in_array($this->route,array('people/otherPower/index','people/otherPower/create','people/otherPower/update','people/otherPower/life'))),
                                    array('label' => 'Местное самоуправление', 'url' => array('/people/local/create'), 'active' => in_array($this->route,array('people/local/create'))),
                                    array('label' => 'Типы персоналий', 'url' => array('/people/peopleGroup/index'), 'active' => in_array($this->route,array('people/peopleGroup/index'))),
                                )
                            ),

                            array('label' => 'Экспертные советы', 'url' => array('/admin/experts/index')),


                            array(
                                'label' => 'Модули',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'Карусель ссылок', 'url' => array('/links/back/index')),
                                    array('label' => 'Губернатор', 'url' => array('/gubernator/back/index'), 'active' => in_array($this->route,array('gubernator/back/index','gubernator/back/create','gubernator/back/update','gubernator/back/info',))),
                                    array('label' => 'Рассылки', 'url' => array('/mailing/mailSubscribe/index'), 'active' => in_array($this->route,array(
                                        'mailing/mailSubscribe/index','mailing/mailSubscribe/update','mailing/mailSubscribe/create','mailing/mailSubscribeFiles/index',
                                        'mailing/mailGroup/index','mailing/mailGroup/update','mailing/mailGroup/create','mailing/mailGroupEmailList/update','mailing/mailGroupEmailList/index','mailing/mailGroupEmailList/createFile','mailing/mailGroupEmailList/create',
                                        'mailing/mailEmailList/index','mailing/mailEmailList/update','mailing/mailEmailList/createFile','mailing/mailEmailList/create',
                                        'mailing/mailTemplate/index','mailing/mailTemplate/update','mailing/mailTemplate/create'))),
                                    array('label' => 'Часто задаваемые вопросы', 'url' => array('/faqs/back/index'), 'active' => in_array($this->route,array('faqs/back/index','faqs/back/create','faqs/back/update',))),
                                    array('label' => 'Горячие линии', 'url' => array('/feedback/hotlines/index'), 'active' => in_array($this->route,array('feedback/hotlines/index','feedback/hotlines/create','feedback/hotlines/update',))),
                                    array('label' => 'Ссылки на соц.сети', 'url' => array('/social/back/index'), 'active' => in_array($this->route,array('/social/back/index'))),
                                )
                            ),
                            array(
                                'label' => 'Медиа',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'Фотогалерея', 'url' => array('/photoGallery/back/index'), 'active' => in_array($this->route,array('photoGallery/back/index','photoGallery/back/create','photoGallery/back/update',))),
                                    array('label' => 'Видеогалерея', 'url' => array('/video/back/index'), 'active' => in_array($this->route,array('video/back/index','video/back/create','video/back/update',))),
                                    array('label' => 'Аудиоархив', 'url' => array('/audio/back/index'), 'active' => in_array($this->route,array('audio/back/index','audio/back/create','audio/back/update',))),
                                )
                            ),
                            array('label' => 'Административное деление', 'url' => array('/map/back/index')),
                            array('label' => 'Контактная информация', 'url' => array('/contact/back/index'), 'active' => in_array($this->route,array('contact/back/index','contact/back/create','contact/back/update',))),
                        )),

//                array('label' => 'Библиотека',
//                    'itemOptions' => array('class' => 'icon icon-folder dropdown-toggle'),
//                    'items' => array(
//                        array('label' => 'Фотоархив', 'url' => array('/photoGallery/allPhoto/index')),
//                        array('label' => 'Документы', 'url' => array('/documents/allFiles/index'), 'active' => in_array($this->route,array('documents/allFiles/index','documents/file/update',))),
//                    )
//                ),

                    array('label' => 'Структура',
                        'itemOptions' => array('class' => 'icon icon-line dropdown-toggle'),
                        'items' => array(
                            array('label' => 'Структура данных', 'url' => array('/navigation/back/index', 'alias' => 'main_menu'), 'active' => in_array($this->route,array('navigation/back/index','navigation/back/create','navigation/back/update',))),
                            array('label' => 'Навигация', 'url' => array('/navigation/menu/index'), 'active' => in_array($this->route,array('navigation/menu/index','navigation/menu/create','navigation/menu/update',))),
                            array('label' => 'Субпорталы', 'url' => array('/portals/back/index'), 'active' => in_array($this->route,array('portals/back/index','portals/back/create','portals/back/update',))),
                            array('label' => 'Группы субпорталов', 'url' => array('/portals/groups/index')),
                            array('label' => 'ИОГВ', 'url' => array('/portals/executives/index')),
                        )
                    ),

                    array('label' => 'Пользователи',
                        'itemOptions' => array('class' => 'icon icon-users dropdown-toggle'),
                        'items' => array(
                            array('label' => 'Настройки доступа', 'url' => array('/admin/main/StaticPageAccess'), 'active' => in_array($this->route, array('admin/main/StaticPageAccess', 'admin/main/staticPageAccessUpdate'))),
                            array('label' => 'Управление пользователями', 'url' => array('/user/manage/admin'), 'active' => in_array($this->route, array('user/manage/admin','user/profileField/admin'))),
                            array('label' => 'Группы и права пользователей', 'url' => array('/rights/assignment/view'), 'active' => @Yii::app()->controller->module->id == 'rights'),
                        )
                    ),

                    array(
                        'label' => 'Настройки',
                        'itemOptions' => array('class' => 'icon icon-settings dropdown-toggle'),
                        'items' => array(
                            array('label' => 'Настройки почты', 'url' => array('/mail/back/index')),
                            array('label' => 'Счетчики', 'url' => array('/counters/back/index'), 'active' => in_array($this->route, array('counters/back/index','counters/back/create','counters/back/update'))),
                        )
                    ),

                    array(
                        'label' => 'Сервисы',
                        //'url' => array('/admin/main/service'),
                        'itemOptions' => array('class' => 'icon icon-service dropdown-toggle'),
                        'items' => array(
                            array('label' => 'Обратная связь', 'url' => array('/feedback/back/index'), 'active' => in_array($this->route,array('feedback/back/index','feedback/back/view',))),
                        )
                    ),
                    array(
                        'label' => 'Журнал',
                        'url' => array('/admin/main/journal'),
                        'itemOptions' => array('class' => 'icon icon-book'),
                    ),
                    array(
                        'label' => 'Корзина',
                        'url' => array('/deleted/back/index'),
                        'itemOptions' => array('class' => 'icon icon-trash'),
                    ),

                );
            }
            else
            {
                $items = array(
                    array('label' => 'Контент',
                        'itemOptions' => array('class' => 'icon icon-content dropdown-toggle'),
                        'items' => array(
                            array(
                                'label' => 'Пресс центр',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'linkOptions' => $this->visibleNavigationElement('press') ? array() : array('style' => 'display: none;'),
                                'items' => array(
                                    array('label' => 'События региона', 'url' => array('/pages/back/index', 'type' => '1'), 'linkOptions' => $this->visibleNavigationElement('event') ? array() : array('style' => 'display: none;')),
                                    array('label' => 'Новости', 'url' => array('/news/back/index'), 'active' => in_array($this->route,array('news/back/index','news/back/create','news/back/update','news/subscribers/index','news/type/index')), 'linkOptions' => $this->visibleNavigationElement('news') ?  '' : array('style' => 'display: none;')),
                                    array('label' => 'Томская область в СМИ', 'url' => array('/smi/back/index'), 'active' => in_array($this->route,array('smi/back/index','smi/back/create','smi/back/update',)), 'linkOptions' => $this->visibleNavigationElement('smi') ?  '' : array('style' => 'display: none;')),
                                    array('label' => 'Календарь мероприятий', 'url' => array('/afisha/back/index'), 'active' => in_array($this->route,array('afisha/back/index','afisha/back/create','afisha/back/update','afisha/back/settings',)), 'linkOptions' => $this->visibleNavigationElement('afisha') ?  '' : array('style' => 'display: none;')),
                                    array('label' => 'Стенограммы', 'url' => array('/pages/back/index', 'type' => '3'), 'linkOptions' => $this->visibleNavigationElement('stena') ?  '' : array('style' => 'display: none;')),
                                ),
                            ),
                            array(
                                'label' => 'Открытый регион',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array(
                                        'label' => 'Обращения граждан',
                                        'itemOptions' => array('class' => 'dropdown-toggle'),
                                        'linkOptions' => $this->visibleNavigationElement('appeal') ? array() : array('style' => 'display: none;'),
                                        'items' => array(
                                            array('label' => 'Общая информация', 'url' => array('/appeal/back/index', 'page' => 'main_info')),
//                                        array('label' => 'График приема граждан', 'url' => array('/appeal/schedule/index')),
                                            array('label' => 'Место, время и порядок приема', 'url' => array('/appeal/place/index')),
                                            array('label' => 'Обзор обращений', 'url' => array('/appeal/review/index')),
                                        )
                                    ),
                                    array(
                                        'label' => 'Независимая оценка',
                                        'itemOptions' => array('class' => 'dropdown-toggle'),
                                        'linkOptions' => $this->visibleNavigationElement('or_no') ? array() : array('style' => 'display: none;'),
                                        'items' => array(
                                            array('label' => 'Правовые основания проведения независимой оценки', 'url' => array('/independentEvaluation/reason/index')),
                                            array('label' => 'Методические рекомендации', 'url' => array('/independentEvaluation/recommendation/index')),
                                            array('label' => 'Организационное обеспечение', 'url' => array('/independentEvaluation/support/index')),
                                            array('label' => 'Реализация независимой оценки в Томской области', 'url' => array('/independentEvaluation/realization/index')),
                                            array('label' => 'Результаты проведения независимой оценки', 'url' => array('/independentEvaluation/result/index')),
                                        )
                                    ),
                                    array('label' => 'Открытые данные', 'url' => array('/opendata/back/index'), 'active' => in_array($this->route,array('opendata/back/index','opendata/back/create','opendata/back/update','opendata/back/settings','opendata/version/index',))),
                                    array('label' => 'Обсуждения законопроектов', 'url' => array('/discuss/back/index'), 'active' => in_array($this->route,array('discuss/back/index','discuss/back/create','discuss/back/update','comments/comment/admin'))),
                                    array('label' => 'Оценка регулирующего воздействия', 'url' => array('/rating/back/index'), 'active' => in_array($this->route,array('rating/back/index','rating/back/create','discuss/back/update',))),
                                    array('label' => 'Опросы', 'url' => array('/vote/back/index'), 'active' => in_array($this->route,array('vote/back/index','vote/back/create','vote/back/update',)), 'linkOptions' => $this->visibleNavigationElement('or_polls') ?  '' : array('style' => 'display: none;')),
                                    array('label' => 'Конкурсы', 'url' => array('/contests/back/index'), 'active' => in_array($this->route,array('contests/back/index','contests/back/create','contests/back/update',))),
                                )
                            ),

                            array('label' => 'Информационные системы, банки данных, реестры, регистры', 'url' => array('/systems/back/index'), 'active' => in_array($this->route, array('systems/back/index', 'systems/back/create'))),
                            array('label' => 'Формы обращений и заявлений', 'url' => array('/forms/back/index'), 'active' => in_array($this->route, array('forms/back/index', 'forms/back/create'))),
                            array('label' => 'Нормативно-правовые акты', 'url' => array('/documents/back/index'), 'active' => (in_array($this->route,array('documents/back/index', 'documents/npa/index')) && !isset($_GET['alias'])), 'linkOptions' => $this->visibleNavigationElement('npa') ? array() : array('style' => 'display: none;')),
                            array('label' => 'Проекты НПА', 'url' => array('/npa/back/index'), 'active' => in_array($this->route, array('npa/back/index', 'npa/back/create')) && !isset($_GET['alias'])),
                            array('label' => 'Административные регламенты', 'url' => array('/regulations/back/index'), 'active' => in_array($this->route,array('regulations/back/index','regulations/back/create','regulations/back/update')) && !isset($_GET['alias']), 'linkOptions' => $this->visibleNavigationElement('reglaments') ? array() : array('style' => 'display: none;')),
                            array('label' => 'Кадровая политика', 'url' => array('/staff/back/index'), 'active' => in_array($this->route,array('staff/back/index','staff/back/create','staff/back/update',)), 'linkOptions' => $this->visibleNavigationElement('staff') ? array() : array('style' => 'display: none;')),
                            array(
                                'label' => 'Противодействие коррупции',
                                //'url' => Yii::app()->createUrl('/antiCorruption/back'),
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'items' => array(
                                    array('label' => 'Нормативно-правовые акты', 'url' => array('/antiCorruption/document/index'), 'linkOptions' => $this->visibleNavigationElement('pk_npa') ? array() : array('style' => 'display: none;')),
                                    array('label' => 'Независимая антикоррупциионная экспертиза', 'url' => array('/antiCorruption/expertise/index')),
                                    array('label' => 'Методические материалы', 'url' => array('/antiCorruption/methodical/index'), 'linkOptions' => $this->visibleNavigationElement('pk_materials') ? array() : array('style' => 'display: none;')),
                                    array('label' => 'Формы справок о доходах и расходах', 'url' => array('/antiCorruption/certificate/index'), 'linkOptions' => $this->visibleNavigationElement('pk_forms') ? array() : array('style' => 'display: none;')),
                                    array('label' => 'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера', 'url' => array('/antiCorruption/public/index'), 'linkOptions' => $this->visibleNavigationElement('pk_about') ? array() : array('style' => 'display: none;')),
                                    array(
                                        'label' => 'Комиссия Администрации Томской области по соблюдению требований к служебному поведению',
                                        //'url' => Yii::app()->createUrl('/antiCorruption/commission'),
                                        'linkOptions' => $this->visibleNavigationElement('pk_commission') ? array() : array('style' => 'display: none;'),
                                        'itemOptions' => array('class' => 'dropdown-toggle'),
                                        'items' => array(
                                            array('label' => 'Состав комиссии', 'url' => array('/antiCorruption/members/index')),
                                            array('label' => 'Положение', 'url' => array('/antiCorruption/situation/index')),
                                            array('label' => 'План работы', 'url' => array('/antiCorruption/schedule/index')),
                                            array('label' => 'Материалы заседаний', 'url' => array('/antiCorruption/meeting/index')),
                                            array('label' => 'Информационные материалы', 'url' => array('/antiCorruption/info/index')),
                                            array('label' => 'Формы обращений', 'url' => array('/antiCorruption/appeal/index')),
                                        )
                                    ),
                                )
                            ),
                            array('label' => 'Органы власти',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'linkOptions' => $this->visibleNavigationElement('ov') ? array() : array('style' => 'display: none;'),
                                'items' => array(
                                    array('label' => 'Персоналии', 'url' => array('/people/back/index'), 'active' => in_array($this->route,array('people/back/index','people/back/create','people/back/update','people/peopleUnit/index','people/peopleStaff/index','people/back/life')), 'linkOptions' => $this->visibleNavigationElement('ov_person') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Ведомства', 'url' => array('/people/office/index'), 'active' => in_array($this->route,array('people/office/index','people/office/create','people/office/update','people/back/life')), 'linkOptions' => $this->visibleNavigationElement('ov_life') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Судебная власть', 'url' => array('/people/law/index'), 'active' => in_array($this->route,array('people/law/index','people/law/create','people/law/update','people/back/life')), 'linkOptions' => $this->visibleNavigationElement('ov_law') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Главы органов местного самоуправления', 'url' => array('/people/iogv/index'), 'active' => in_array($this->route,array('people/iogv/index','people/iogv/create','people/iogv/update','people/back/life')), 'linkOptions' => $this->visibleNavigationElement('ov_local_people') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Территориальные органы федеральных органов власти', 'url' => array('/people/terr/index'), 'active' => in_array($this->route,array('people/terr/index','people/terr/create','people/terr/update','people/back/life')), 'linkOptions' => $this->visibleNavigationElement('ov_ter') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Органы власти', 'url' => array('/people/power/index'), 'active' => in_array($this->route,array('people/power/index','people/power/create','people/power/update','people/power/life')), 'linkOptions' => $this->visibleNavigationElement('ov_power') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Иные органы власти', 'url' => array('/people/otherPower/index'), 'active' => in_array($this->route,array('people/otherPower/index','people/otherPower/create','people/otherPower/update','people/otherPower/life')), 'linkOptions' => $this->visibleNavigationElement('ov_other') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Местное самоуправление', 'url' => array('/people/local/create'), 'active' => in_array($this->route,array('people/local/create')), 'linkOptions' => $this->visibleNavigationElement('ov_local') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Типы персоналий', 'url' => array('/people/peopleGroup/index'), 'active' => in_array($this->route,array('people/peopleGroup/index'))),
                                )
                            ),
                            array(
                                'label' => 'Медиа',
                                'itemOptions' => array('class' => 'dropdown-toggle'),
                                'linkOptions' => $this->visibleNavigationElement('media') ? array() : array('style' => 'display: none;'),
                                'items' => array(
                                    array('label' => 'Фотогалерея', 'url' => array('/photoGallery/back/index'), 'active' => in_array($this->route,array('photoGallery/back/index','photoGallery/back/create','photoGallery/back/update',)), 'linkOptions' => $this->visibleNavigationElement('photo') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Видеогалерея', 'url' => array('/video/back/index'), 'active' => in_array($this->route,array('video/back/index','video/back/create','video/back/update',)), 'linkOptions' => $this->visibleNavigationElement('video') ? array() : array('style' => 'display: none;'),),
                                    array('label' => 'Аудиоархив', 'url' => array('/audio/back/index'), 'active' => in_array($this->route,array('audio/back/index','audio/back/create','audio/back/update',)), 'linkOptions' => $this->visibleNavigationElement('audio') ? array() : array('style' => 'display: none;'),),
                                )
                            ),
                            array('label' => 'Административное деление', 'url' => array('/map/back/index'), 'linkOptions' => $this->visibleNavigationElement('admin_div') ? array() : array('style' => 'display: none;'),),
                        )),
                    array('label' => 'Структура',
                        'itemOptions' => array('class' => 'icon icon-line dropdown-toggle'),
                        'items' => array(
                            array('label' => 'Структура данных', 'url' => array('/navigation/back/index', 'alias' => 'main_menu'), 'active' => in_array($this->route,array('navigation/back/index','navigation/back/create','navigation/back/update',))),
                        )
                    ),
                );
            }
        }
        else
        {
            $people = array(
                array('label' => 'Руководство', 'url' => array('/people/back/index'), 'active' => in_array($this->route,array('people/back/index','people/back/create','people/back/update','people/back/life','people/peopleUnit/index','people/peopleStaff/index'))),
                array('label' => 'Ведомства', 'url' => array('/people/committee/index'), 'active' => in_array($this->route,array('people/committee/index','people/committee/create','people/committee/update',))),
                array('label' => 'Местное самоуправление', 'url' => array('/people/local/create'), 'active' => in_array($this->route,array('people/local/create'))),
                array('label' => 'Типы персоналий', 'url' => array('/people/peopleGroup/index'), 'active' => in_array($this->route,array('people/peopleGroup/index'))),
            );

            if ($portal->theme == 'expert' or $portal->theme == 'expert_main' )
                $people = array(
                    array('label' => 'Руководство', 'url' => array('/people/expert/index'), 'active' => in_array($this->route,array('people/expert/index','people/expert/create','people/expert/update','people/peopleUnit/index','people/peopleStaff/index'))),
                    array('label' => 'Типы персоналий', 'url' => array('/people/peopleGroup/index'), 'active' => in_array($this->route,array('people/peopleGroup/index'))),
                );


            $items = array(
                array(
                    'label' => 'Рабочий стол',
                    'url' => array('/admin/main/index'),
                    'itemOptions' => array('class' => 'icon icon-home'),
                ),

                array('label' => 'Контент',
                    'itemOptions' => array('class' => 'icon icon-content dropdown-toggle'),
                    'items' => array(
                        array('label' => 'Статические страницы',
                            'itemOptions' => array('class' => 'dropdown-toggle'),
                            'items' => array(
                                array('label' => 'Статические страницы', 'url' => array('/pages/back/index', 'type' => 0)),
                            )),
                        array('label' => 'Главная страница', 'url' => array('/pages/back/subportalmain')),
                        array('label' => 'Пресс центр',
                            'itemOptions' => array('class' => 'dropdown-toggle'),
                            'items' => array(
                                array('label' => 'Новости', 'url' => array('/news/back/index'), 'active' => in_array($this->route,array('news/back/index','news/back/create','news/back/update','news/subscribers/index','news/type/index'))),
                                array('label' => 'Календарь мероприятий', 'url' => array('/afisha/back/index'), 'active' => in_array($this->route,array('afisha/back/index','afisha/back/create','afisha/back/settings',))),
                                array('label' => 'Публикации СМИ', 'url' => array('/smi/back/index'), 'active' => in_array($this->route,array('smi/back/index','smi/back/create','smi/back/update',))),
                            )),

                        array(
                            'label' => 'Открытый регион',
                            'itemOptions' => array('class' => 'dropdown-toggle'),
                            'items' => array(
                                array(
                                    'label' => 'Обращения граждан',
                                    'itemOptions' => array('class' => 'dropdown-toggle'),
                                    'items' => array(
                                        array('label' => 'Общая информация', 'url' => array('/appeal/back/index', 'page' => 'main_info')),
//                                        array('label' => 'График приема граждан', 'url' => array('/appeal/schedule/index')),
                                        array('label' => 'Место, время и порядок приема', 'url' => array('/appeal/place/index')),
                                        array('label' => 'Обзор обращений', 'url' => array('/appeal/review/index')),
                                    )
                                ),
                                array(
                                    'label' => 'Независимая оценка',
                                    'itemOptions' => array('class' => 'dropdown-toggle'),
                                    'items' => array(
                                        array('label' => 'Правовые основания проведения независимой оценки', 'url' => array('/independentEvaluation/reason/index')),
                                        array('label' => 'Методические рекомендации', 'url' => array('/independentEvaluation/recommendation/index')),
                                        array('label' => 'Организационное обеспечение', 'url' => array('/independentEvaluation/support/index')),
                                        array('label' => 'Реализация независимой оценки в Томской области', 'url' => array('/independentEvaluation/realization/index')),
                                        array('label' => 'Результаты проведения независимой оценки', 'url' => array('/independentEvaluation/result/index')),
                                    )
                                ),
                                array('label' => 'Опросы', 'url' => array('/vote/back/index'), 'active' => in_array($this->route,array('vote/back/index','vote/back/create','vote/back/update',))),
                                array('label' => 'Конкурсы', 'url' => array('/contests/back/index'), 'active' => in_array($this->route,array('contests/back/index','contests/back/create','contests/back/update',))),
                                array('label' => 'Обсуждения законопроектов', 'url' => array('/discuss/back/index'), 'active' => in_array($this->route,array('discuss/back/index','discuss/back/create','discuss/back/update','comments/comment/admin'))),
                            )
                        ),

                        array('label' => 'Информационные системы, банки данных, реестры, регистры', 'url' => array('/systems/back/index'), 'active' => in_array($this->route, array('systems/back/index', 'systems/back/create'))),
                        array('label' => 'Формы обращений и заявлений', 'url' => array('/forms/back/index'), 'active' => in_array($this->route, array('forms/back/index', 'forms/back/create'))),
                        array('label' => 'Нормативно-правовые акты', 'url' => array('/documents/back/index'), 'active' => in_array($this->route,array('documents/back/index', 'documents/npa/index')) && !isset($_GET['alias'])),
                        array('label' => 'Проекты НПА', 'url' => array('/npa/back/index'), 'active' => in_array($this->route,array('npa/back/index', 'npa/back/create')) && !isset($_GET['alias'])),
                        array('label' => 'Административные регламенты', 'url' => array('/regulations/back/index'), 'active' => in_array($this->route,array('regulations/back/index')) && !isset($_GET['alias'])),
                        array('label' => 'Органы власти',
                            'itemOptions' => array('class' => 'dropdown-toggle'),
                            'items' => $people,
                        ),
                        array(
                            'label' => 'Противодействие коррупции',
                            //'url' => Yii::app()->createUrl('/antiCorruption/back'),
                            'itemOptions' => array('class' => 'dropdown-toggle'),
                            'items' => array(
                                array('label' => 'Нормативно-правовые акты', 'url' => array('/antiCorruption/document/index')),
                                array('label' => 'Независимая антикоррупциионная экспертиза', 'url' => array('/antiCorruption/expertise/index')),
                                array('label' => 'Методические материалы', 'url' => array('/antiCorruption/methodical/index')),
                                array('label' => 'Формы справок о доходах и расходах', 'url' => array('/antiCorruption/certificate/index')),
                                array('label' => 'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера', 'url' => array('/antiCorruption/public/index')),
                                array(
                                    'label' => 'Комиссия Администрации Томской области по соблюдению требований к служебному поведению',
                                    //'url' => Yii::app()->createUrl('/antiCorruption/commission'),
                                    'itemOptions' => array('class' => 'dropdown-toggle'),
                                    'items' => array(
                                        array('label' => 'Состав комиссии', 'url' => array('/antiCorruption/members/index')),
                                        array('label' => 'Положение', 'url' => array('/antiCorruption/situation/index')),
                                        array('label' => 'План работы', 'url' => array('/antiCorruption/schedule/index')),
                                        array('label' => 'Материалы заседаний', 'url' => array('/antiCorruption/meeting/index')),
                                        array('label' => 'Информационные материалы', 'url' => array('/antiCorruption/info/index')),
                                        array('label' => 'Формы обращений', 'url' => array('/antiCorruption/appeal/index')),
                                    )
                                ),
                            )
                        ),
                        array(
                            'label' => 'Модули',
                            'itemOptions' => array('class' => 'dropdown-toggle'),
                            'items' => array(
                                array('label' => 'Карусель ссылок', 'url' => array('/links/back/index')),
                                array('label' => 'Ссылки на соц.сети', 'url' => array('/social/back/index'), 'active' => in_array($this->route,array('/social/back/index'))),
                                array('label' => 'Часто задаваемые вопросы', 'url' => array('/faqs/back/index'), 'active' => in_array($this->route,array('faqs/back/index','faqs/back/create','faqs/back/update',))),
                                array('label' => 'Горячие линии', 'url' => array('/feedback/hotlines/index'), 'active' => in_array($this->route,array('feedback/hotlines/index','feedback/hotlines/create','feedback/hotlines/update',))),
                            )
                        ),
                        array(
                            'label' => 'Медиа',
                            'itemOptions' => array('class' => 'dropdown-toggle'),
                            'items' => array(
                                array('label' => 'Фотогалерея', 'url' => array('/photoGallery/back/index'), 'active' => in_array($this->route,array('photoGallery/back/index','photoGallery/back/create','photoGallery/back/update',))),
                                array('label' => 'Видеогалерея', 'url' => array('/video/back/index'), 'active' => in_array($this->route,array('video/back/index','video/back/create','video/back/update',))),
                            )
                        ),
                        array('label' => 'Контактная информация', 'url' => array('/contact/back/index'), 'active' => in_array($this->route,array('contact/back/index','contact/back/create','contact/back/update',))),
                    )),

//                array('label' => 'Библиотека',
//                    'itemOptions' => array('class' => 'icon icon-folder dropdown-toggle'),
//                    'items' => array(
//                        array('label' => 'Фотоархив', 'url' => array('/photoGallery/allPhoto/index')),
//                        array('label' => 'Документы', 'url' => array('/documents/allFiles/index'), 'active' => in_array($this->route,array('documents/allFiles/index','documents/file/update',))),
//                    )
//                ),

                array('label' => 'Структура',
                    'itemOptions' => array('class' => 'icon icon-line dropdown-toggle'),
                    'items' => array(
                        array('label' => 'Структура данных', 'url' => array('/navigation/back/index', 'alias' => 'main_menu'), 'active' => in_array($this->route,array('navigation/back/index','navigation/back/create','navigation/back/update',))),
                        array('label' => 'Навигация', 'url' => array('/navigation/menu/index'), 'active' => in_array($this->route,array('navigation/menu/index','navigation/menu/create','navigation/menu/update',))),
                    )
                ),

                array('label' => 'Пользователи',
                    'itemOptions' => array('class' => 'icon icon-users dropdown-toggle'),
                    'items' => array(
                        array('label' => 'Список пользователей', 'url' => array('/user/manage/admin'), 'active' => in_array($this->route, array('user/manage/admin','user/profileField/admin'))),
                    )
                ),

                array(
                    'label' => 'Настройки',
                    'itemOptions' => array('class' => 'icon icon-settings dropdown-toggle'),
                    'items' => array(
                        array('label' => 'Настройки почты', 'url' => array('/mail/back/index')),
                        array('label' => 'Счетчики', 'url' => array('/counters/back/index'), 'active' => in_array($this->route, array('counters/back/index','counters/back/create','counters/back/update'))),
                    )
                ),

                array(
                    'label' => 'Сервисы',
                    //'url' => array('/admin/main/service'),
                    'itemOptions' => array('class' => 'icon icon-service dropdown-toggle'),
                    'items' => array(
                        array('label' => 'Обратная связь', 'url' => array('/feedback/back/index'), 'active' => in_array($this->route,array('feedback/back/index','feedback/back/view',))),
                    )
                ),
                array(
                    'label' => 'Журнал',
                    'url' => array('/admin/main/journal'),
                    'itemOptions' => array('class' => 'icon icon-book'),
                ),
                array(
                    'label' => 'Корзина',
                    'url' => array('/deleted/back/index'),
                    'itemOptions' => array('class' => 'icon icon-trash'),
                ),

            );

            if ($portal->theme == 'expert' or $portal->theme == 'expert_main' ) {
//                $items[1]['items'][2]['items'][] = array(
//                    'label' => 'Публикации СМИ',
//                    'url' => array('/smi/back/index'),
//                    'active' => in_array($this->route,array('smi/back/index','smi/back/create','smi/back/update')));

//                $items[1]['items'][] = array(
//                    'label' => 'Протоколы заседаний',
//                    'url' => $this->createUrl('/documents/back/index', array('alias' => 'protocols')),
//                    'active' => in_array($this->route,array('documents/back/index', 'documents/npa/index')) && isset($_GET['alias']) && ($_GET['alias'] == 'protocols')
//                );

                if ($portal->theme == 'expert_main' ) {

                    $items[1]['items'][] = array(
                        'label' => 'Протоколы заседаний, заключения',
                        'url' => array('/experts/expertProtocols/index'),
                        'active' => in_array($this->route,array('experts/expertProtocols/index','experts/expertProtocols/create','experts/expertProtocol/update'))
                    );

                    $items[1]['items'][] = array(
                        'label' => 'Справочник экспертных советов',
                        'url' => array('/experts/expertsHelper/index'),
                        'active' => in_array($this->route,array('experts/expertsHelper/index','experts/expertsHelper/create','experts/expertsHelper/update'))
                    );

                    $items[1]['items'][] = array(
                        'label' => 'База данных экспертов',
                        'url' => array('/experts/back/index')
                    );


                }
            }
        }

        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array('class' => 'main-menu'),
            'items' => $items
        )); ?>
        <a href="" class="support">Техподдержка</a>

        <?php
        echo CHtml::ajaxLink('Техподдержка', $this->createUrl('/admin/main/feedback'), array(
            'success'=>'function(html){
                    jQuery("#feedback_popup").html(html);
                    $("#feedback_dialog").dialog("open");
                }',
        ), array(
            'class' => 'support',
        ));
        ?>
    </div>
</nav>

<main>
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'homeLink' => '<a title="рабочий стол" href="' . $this->createUrl('/admin/main') . '">рабочий стол</a>',
            'links' => $this->breadcrumbs,
            'separator' => '<i></i>',
        )); ?>
    <?php endif ?>

    <div class="content">
        <?php echo $content; ?>
    </div>
</main>

<div class="overlay"></div>

<?php if ($app->user->hasFlash('notice')) : ?>
    <div class="alert alert-success">
        <div class="close"></div>
        <?php echo $app->user->getFlash('notice'); ?>
    </div>
<?php endif; ?>
<?php if ($app->user->hasFlash('error')) : ?>
    <div class="alert alert-error">
        <div class="close"></div>
        <?php echo $app->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'feedback_dialog',
    'options'=>array(
        'title'=>'Техподдержка',
        'autoOpen'=>false,
        'open' => 'js:function(){overlayShow()}',
        'close'=>'js:function(){overlayHide()}',
    ),
)); ?>
<div id="feedback_popup" class="form"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</body>
</html>