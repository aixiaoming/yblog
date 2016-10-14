<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "修改分类：$model->title";
?>





<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><small>修改分类</small></h5>
    </div>
    <div class="ibox-content">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '<div class="form-group"><label class="col-sm-2 control-label">{label}</label><div class="col-sm-10">{input}</div><div class="col-sm-2"></div><div class="col-sm-10">{error}</div></div>'
            ],
        ]); ?>
        <?= $form->field($model, 'parentid')->dropDownList($list) ?>
        <?= $form->field($model, 'title') ?>
        <div class="form-group submit">
            <div class="col-sm-2"></div>
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            <?= Html::resetButton('取消', ['class' => 'btn btn-default', 'name' => 'reset-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
