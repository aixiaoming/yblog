<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Website */
/* @var $form ActiveForm */
?>


<div class="ibox-content">
    <? echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'type',
            'englishtype',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'header' => '操作',
            ],
        ]
    ]);
    ?>
</div>


<!--[-->
<!--'class' => 'yii\grid\ActionColumn',-->
<!--'header' => '操作',-->
<!--'template' => '{view} {update} {update-status}',-->

<!--],-->
