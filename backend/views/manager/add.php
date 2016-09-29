<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '新增管理员';
?>

    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'type')->hiddenInput(['value'=>0])->label(false) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password1')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            <?= Html::resetButton('取消', ['class' => 'btn btn-default', 'name' => 'reset-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>