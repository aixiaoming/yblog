<?php


use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Website */
/* @var $form ActiveForm */
?>

<a href="<? echo Url::to(['website/add'])?>"><button class="btn btn-primary">新增设置</button></a>
<a href="<? echo Url::to(['website/other'])?>"><button class="btn btn-info">其他设置</button></a>


<div class="ibox float-e-margins website-index">
    <div class="ibox-title">
        <h5><small>网站设置</small></h5>
    </div>
    <div class="ibox-content">
        <?php $form = ActiveForm::begin([
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => '<div class="form-group"><label class="col-sm-2 control-label">{label}</label><div class="col-sm-10">{input}</div><div class="col-sm-2"></div><div class="col-sm-10">{error}</div></div>'
                ],
            ]
        ); ?>
        <? foreach($lists as $list):?>
            <?= $form->field($list,"content['$list->type']")->textInput(['value'=>$list->content])->label($list->type) ?>
            <div class="hr-line-dashed"></div>
        <? endforeach;?>
        <div class="form-group submit">
            <div class="col-sm-2"></div>
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>



