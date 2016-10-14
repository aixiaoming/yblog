<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Website */
/* @var $form ActiveForm */
?>
<div class="website-index">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model,'type')->textInput() ?>
    <?= $form->field($model,'englishtype')->textInput() ?>
    <div class="form-group submit">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


<? echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'type',
        'englishtype',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
            'header' => '操作',
        ],
    ]
]);
?>