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


<div class="website-update">
    <?php $form = ActiveForm::begin(); ?>
<?= $form->field($model,'type')->textInput() ?>
<?= $form->field($model,'englishtype')->textInput() ?>
<div class="form-group submit">
    <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>