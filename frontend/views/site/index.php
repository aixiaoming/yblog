<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = '首页';
?>
<? foreach ($articles as $article):?>
    <a href="<? echo Url::to(['article/show','id'=>$article->id])?>"><? echo $article->title;?></a><br>
<? endforeach;?>
