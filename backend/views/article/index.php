<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;

$this->title='文章列表';
?>

<a href="<? echo Url::to(['article/add'])?>"><button class="btn btn-info">新建文章</button></a>

<? echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        [
            'label' => '封面图片',
            'format' => [
                'image',
                [
                    'width'=>'30',
                ]
            ],
            'value' => function ($model) {
                return $model->img;
            }
        ],
        [
            'label'=>'发表日期',
            'format' => ['date', 'php:Y-m-d h:m:s'],
            'value' => 'createtime'
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ]
]);
?>