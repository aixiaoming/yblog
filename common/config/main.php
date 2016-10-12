<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'zh-CN',
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '../web/upload/img',
            'uploadUrl' => '../web/upload/img',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],

];
