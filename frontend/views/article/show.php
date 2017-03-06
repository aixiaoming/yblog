<?php
/* @var $this yii\web\View */
use yii\captcha\Captcha;

$this->registerJsFile('../web/js/changyan.js',['position'=> $this::POS_END]);
//$this->registerJsFile('../web/js/baidufenxiang.js',['position'=> $this::POS_END]);
$this->registerJsFile('../web/js/article_show.js',['position'=> $this::POS_END]);
$this->title="$article->title";
$this->registerMetaTag(['name' => 'description', 'content' => "$article->abstract"]);
$this->registerMetaTag(['name' => 'keywords', 'content' => "$article->keywords"]);
?>


<div class="article-show" id="layer-photos">
    <h2 class="title"><? echo $article->title; ?></h2>
    <div class="content">
        <? echo $article->content; ?>
    </div>
</div>



<!--百度分享 不适应https  暂时取消
<div class="bdsharebuttonbox">
    <a href="http://localhost/yblog/frontend/web/index.php?r=article%2Fshow&id=8" class="bds_more" data-cmd="more"></a>
    <a href="#" class="bds_qzone" data-cmd="qzone"  title="分享到QQ空间"></a>
    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
    <a href="#" class="bds_renren" data-cmd="renren"  title="分享到人人网"></a>
    <a href="#"  class="bds_weixin"  data-cmd="weixin" title="分享到微信"></a>
</div>-->


<!--畅言 不适应https  暂时取消
PC和WAP自适应版-->
<div id="SOHUCS" sid="<? echo $article->id; ?>" ></div>


