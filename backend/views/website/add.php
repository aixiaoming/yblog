<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Website */
/* @var $form ActiveForm */
?>
<div class="website-index">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model,'type')->textInput() ?>
    <div class="form-group submit">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>