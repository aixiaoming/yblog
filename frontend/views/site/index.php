<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\LinkPager;



$this->title = '首页';
?>



<? foreach ($articles as $article):?>
    <div  class="row index-list">
        <div class="col-sm-4 img">
            <a href="<? echo Url::to(['article/show','id'=>$article->id])?>"><img src="<? echo $article->img;?>"></a>
        </div>
        <div class="col-sm-8">
            <a href="<? echo Url::to(['article/show','id'=>$article->id])?>"><? echo $article->title;?></a>
            <div class="col-sm-12 tip">
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-calendar">
                        <? echo date('Y-m-d',$article->createtime);?>
                    </span>
                </div>

                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-eye-open">
                        浏览 <? echo $article->seenum;?>
                    </span>
                </div>

                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-comment">
                        评论 &nbsp;<span id = "sourceId::<? echo $article->id; ?>" class = "cy_cmt_count" ></span>
                    </span>
                </div>
            </div>
            <div>
                <p><? echo $article->abstract;?></p>
            </div>
        </div>
    </div>
<? endforeach;?>

<div class="row">
    <?echo LinkPager::widget([
        'pagination' => $pager,
    ]);?>
</div>

<script id="cy_cmt_num" 
			src="https://changyan.sohu.com/upload/plugins/plugins.list.count.js?clientId=cysI0uifa">
</script>







