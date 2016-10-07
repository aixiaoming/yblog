<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;
use common\models\search\ArticleSearch;

$this->title='文章列表';
?>

<a href="<? echo Url::to(['article/add'])?>"><button class="btn btn-info">新建文章</button></a>

<? echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'title',
            'value' => 'title',
            'headerOptions' => ['width' => '30%'],
        ],
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
            'label' => '状态',
            'value' => function ($model) {
                $state = [
                    '1' => '公开',
                    '0' => '隐藏',
                ];
                return $state[$model->issee];
            },
        ],
        [
            'label' => '评论',
            'value' => function ($model) {
                $state = [
                    '1' => '允许',
                    '0' => '禁止',
                ];
                return $state[$model->issay];
            },
        ],
        [
            'label' => '来源',
            'value' => function ($model) {
                $state = [
                    '1' => '原创',
                    '0' => '转载',
                ];
                return $state[$model->isoriginal];
            },
        ],
        'seenum',
        [
            'label'=>'发表日期',
            'attribute' => 'createtime',
            'format' => ['date', 'php:Y-m-d h:m:s'],
            'value' => 'createtime'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
            'header' => '操作',
        ],
    ]
]);
?>