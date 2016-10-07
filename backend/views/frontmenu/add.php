<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '新增分类';
?>

<div class="col-lg-5">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'parentid')->dropDownList($list) ?>

        <?= $form->field($model, 'title') ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        <?= Html::resetButton('取消', ['class' => 'btn btn-default', 'name' => 'reset-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
