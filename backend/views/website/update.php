<?php
/**
 * Created by PhpStorm.
 * User: zhao晓明
 * Date: 2016/10/12
 * Time: 19:52
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>




<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5><small>更新设置</small></h5>
    </div>
    <div class="ibox-content">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '<div class="form-group"><label class="col-sm-2 control-label">{label}</label><div class="col-sm-10">{input}</div></div>{error}'
            ],
        ]); ?>
        <?= $form->field($model,'type')->textInput() ?>
        <?= $form->field($model,'englishtype')->textInput() ?>
        <div class="form-group submit">
            <div class="col-sm-2"></div>
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>