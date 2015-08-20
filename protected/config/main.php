<?php

Yii::setPathOfAlias('generator', dirname(__FILE__) . '/../extensions/CrudGenerator');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'ОИП Томск',

    'language' => 'ru',

    'preload' => array('log'),

    'import' => array(
        'application.models.*',
        'application.models.StaticPagesTypes.*',

        'application.components.*',
        'application.modules.*',
        'application.enums.*',
        'application.helpers.*',
        'application.behaviors.*',

        'application.widgets.*',

        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',

        'application.modules.video.models.*',

        'application.modules.rights.*',
        'application.modules.rights.models.*',
        'application.modules.rights.components.*',

        'application.modules.navigation.models.*',

        'application.modules.portals.models.*',

        'application.modules.pages.models.*',

        'application.modules.news.models.*',

        'application.modules.photoGallery.models.*',

        'application.modules.vote.models.*',

        'application.modules.video.models.*',

        'application.modules.documents.models.*',

        'application.modules.afisha.models.*',

        'application.modules.audio.models.*',

        'application.modules.appeal.models.*',

        'application.modules.discuss.models.*',

        'application.modules.links.models.*',

        'application.modules.contact.models.*',
        'application.modules.antiCorruption.models.*',
        'application.modules.comments.models.*',
        'application.modules.contests.models.*',
        'application.modules.faqs.models.*',
        'application.modules.feedback.models.*',
        'application.modules.feedback.enums.*',
        'application.modules.gubernator.models.*',
        'application.modules.mailing.models.*',
        'application.modules.opendata.models.*',
        'application.modules.publicReport.models.*',
        'application.modules.rating.models.*',
        'application.modules.smi.models.*',
        'application.modules.staff.models.*',
        'application.modules.search.models.*',
        'application.modules.people.models.*',
        'application.modules.npa.models.*',

        'application.modules.files.models.*',

        'application.modules.stenogramm.models.*',
        'application.modules.independentEvaluation.models.*',
        'application.modules.map.models.*',
        'application.modules.experts.models.*',
    ),

    'defaultController' => 'main',

    'modules' => array(
        'pages',
        'portals',
        'navigation' => array(
            // делает рабочими типы меню
            'allowMenuTypes' => true
        ),
        'files',
        'people',
        'user' =>array(
            'loginUrl' => array('/user/login'),
            'profileUrl' => array('/user/profile')
        ),
        'log',
        'rights',
        'mailing',
        'mail',
        'news',
        'appeal',
        'contact',
        'antiCorruption',
        'links',
        'feedback',
        'documents',
        'photoGallery',
        'audio',
        'npa',
        'vote',
        'regulations',
        'rating',
        'afisha',
        'contests',
        'video',
        'staff',
        'search',
        'social',
        'opendata',
        'events',
        'faqs',
        'counters',
        'smi',
        'gubernator',
        'gallery',
        'legislativeDuma',
        'discuss',
        'verbReport',
        'publicReport',
        'deleted',
        'independentEvaluation',
        'map',
        'experts',
        'forms',
        'systems',
        'stenogramm',
        'comments' => array(
            'defaultModelConfig' => array(
                'registeredOnly' => false,
                'useCaptcha' => false,
                'allowSubcommenting' => false,
                'premoderate' => true,
                'postCommentAction' => 'comments/comment/postComment',
                'isSuperuser' => '',
                'orderComments' => 'DESC',
            ),
            'commentableModels' => array(
                'Discuss' => array(),

                //model with default settings
                'ImpressionSet',
            ),
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'root',
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'generator.gii',
            ),
        ),
    ),

    'theme' => 'tomsk',

    'components' => array(
//        'cache' => array(
//            'class' => 'CDbCache',
//            'connectionID' => 'db',
//        ),
        'curl' => array(
            'class' => 'ext.Curl',
            'options' => array(
                CURLOPT_COOKIEJAR => $_SERVER['DOCUMENT_ROOT'].'/cookie.txt',
                CURLOPT_COOKIEFILE => $_SERVER['DOCUMENT_ROOT'].'/cookie.txt'
            ),
        ),

        'themeManager' => array(
            'basePath' => '../protected/themes'
        ),

        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            'driver' => 'GD',
        ),
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
        ),
        'mailchimp' => array(
            'class' => 'ext.mailchimp.EMailChimp2',
            'apikey' => 'd5966d7efdbb6d9c0d9209fc8a7f1530-us9',
            'listId' => 'c454309007',
        ),
        'user' => array(
            'class' => 'RWebUser',
            'loginUrl' => array('user/login'),
            'allowAutoLogin' => true,
            'identityCookie' => array('domain' => '.tomsk.dpridprod.ru'),
        ),

        'authManager' => array(
            'class' => 'RDbAuthManager',
            'defaultRoles' => array('Guest'), // дефолтная роль

            // названия таблиц с ролями их отношениями и тд
            'itemTable' => 'usr_AuthItem',
            'assignmentTable' => 'usr_AuthAssignment',
            'itemChildTable' => 'usr_AuthItemChild',
            'rightsTable' => 'usr_Rights'
        ),
/*
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'gii' => 'gii',
                '/dokumenty-reestry-banki-dannyh' => '/systems/front',
                '/Informatsionnie-sistemi--banki-dannih--reestri--registri' => '/systems/front',
                '/formy-obraschenij-i-zajavlenij' => '/forms/front',
                '/Formi-obrashteniy--zayavleniy' => '/forms/front',
                '/admin' => '/admin/main',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<url:[\w-_]+>' => '/pages/front',
            ),
        ),*/
        'db' => include('connect.php'),

//        'errorHandler' => array(
//            'errorAction' => 'main/error',
//        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CDbLogRoute',
                    'levels' => 'error, warning',
                    'connectionID' => 'db',
                    'autoCreateLogTable' => true,
                ),
                array(
                    'class'=>'CWebLogRoute',
                    // you can include more levels separated by commas
                    'levels'=>'trace, info, error, warning, vardump',
                    // categories are those you used in the call to Yii::trace
                    'categories'=>'application',
                    // This is self-explanatory right? but also works in Chrome!
                    'showInFireBug'=>true
                ),

//                array(
//                    'class' => 'CProfileLogRoute',
//                    'levels' => 'profile',
//                    'enabled' => true,
//                    'showInFireBug' => true
//                ),
            ),
        ),
    ),

    'params' => array('mainPortalId'=>1)
);