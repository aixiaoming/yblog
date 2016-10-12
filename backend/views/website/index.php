<?php


use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Website */
/* @var $form ActiveForm */
?>


<a href="<? echo Url::to(['website/add'])?>"><button class="btn btn-primary">新增</button></a>

<?php $form = ActiveForm::begin(); ?>
    <? foreach($lists as $list):?>
        <?= $form->field($list,"content['$list->type']")->textInput(['value'=>$list->content])->label($list->type) ?>
    <? endforeach;?>
    <div class="form-group submit">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>



