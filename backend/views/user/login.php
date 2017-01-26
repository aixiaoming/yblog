<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台登录</title>
    <link href="../web/css/bootstrap.min.css" rel="stylesheet">
    <link href="../web/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../web/css/animate.css" rel="stylesheet">
    <link href="../web/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div  class="col-md-3"></div>
        <div class="col-md-6">
            <div class="ibox-content">

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                ]); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false) ?>
                <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>

                <a href="#">
                    <small>Forgot password?</small>
                </a>

                <p class="text-muted text-center">
                    <small>Do not have an account?</small>
                </p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
                <p class="m-t">
                    <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                </p>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright Example Company
        </div>
        <div class="col-md-6 text-right">
            <small>© 2014-2015</small>
        </div>
    </div>
</div>

</body>

</html>

