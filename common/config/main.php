<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'storage' => [
            'class' => 'common\components\Storage'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
