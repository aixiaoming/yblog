<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form ActiveForm */
$this->title="修改 $model->title";
?>
<div class="article-update">

    <?php $form = ActiveForm::begin( ['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="col-lg-8">
        <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'abstract')->textarea() ?>
        <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className()           ,['clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
        ])?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'img')->widget(FileInput::className(), [
            'options' => ['accept' => 'uploads/*'],
            'pluginOptions' => [
                'showUpload' => false,
                'browseLabel' => '选择图片',
                'removeLabel' => '删除',
                'maxFileCount' => 1,  // 最多上传的文件个数限制
                'initialPreview' => Html::img(Url::to($model->img))
            ],
        ]) ?>
        <!--            r \common\models\User::find()->select(['id','username'])->where(['status'=>10,'type'=>0])->all()-->

        <?= $form->field($model, 'issee')->checkbox() ?>
        <?= $form->field($model, 'userid')->widget(Select2::classname(), [
            'data' =>\yii\helpers\ArrayHelper::map(common\models\User::find()->where(['status'=>10,'type'=>0])->all(),'id','username'),
            'options' => ['placeholder' => '请选择作者'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>
        <?= $form->field($model, 'menuid')->widget(Select2::classname(), [
            'data' =>\yii\helpers\ArrayHelper::map(common\models\Frontmenu::find()->all(),'id','title'),
            'options' => ['placeholder' => '请选择分类'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>
        <?= $form->field($model, 'issay')->checkbox() ?>
        <?= $form->field($model, 'isoriginal')->checkbox() ?>
        <?= $form->field($model, 'seenum')->textInput(['value'=>0])?>
        <div class="form-group submit">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary col-lg-12']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div><!-- article-add -->