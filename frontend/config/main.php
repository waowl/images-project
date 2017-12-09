<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        [
            'class' => 'frontend\components\LanguageSelector'
        ]
    ],
    'layout'=> 'layout',
    'language' => 'en',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
        'post' => [
            'class' => 'frontend\modules\post\Module',
        ],
    ],
    'components' => [

        'request' => [
            'csrfParam' => '_csrf-frontend',

        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'feedService' => [
            'class' => 'frontend\components\FeedService'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'profile/edit/<nickname:\w+>' => 'user/profile/edit',
                'profile/<nickname:\w+>' => 'user/profile/view',
                'post/<id:\d+>' => 'post/default/view',
                'post/delete/<id:\d+>' => 'post/default/delete',
                'post/create' => 'post/default/create',
                'comment/delete/<id:\d+>' => 'post/default/comment-delete',
                'comment/edit/<id:\d+>' => 'post/default/comment-edit'
            ],
        ],

    ],
    'params' => $params,
];
