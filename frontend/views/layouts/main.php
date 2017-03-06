<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;


AppAsset::register($this);
$this->registerJsFile('../../../backend/web/js/jquery.min.js',['position'=> $this::POS_HEAD]);
$this->registerJsFile('../../backend/web/js/bootstrap.min.js');
$this->registerJsFile('../../../common/assets/layer/layer.js',['position'=> $this::POS_HEAD]);
$this->registerCssFile('../../../common/assets/layer/skin/default/layer.css',['position'=> $this::POS_HEAD]);
$this->registerJsFile('../../frontend/web/js/zzsc.js');




?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="<? echo $this->params['title']; ?>-建立自己的个人自媒体博客！本博客主要关注IT互联网领域并分享相关的下载资源,搜索引擎优化(SEO)知识,建站心得,特效代码,美文美句,推广营销等方面的经验心得。" />
    <meta name="ThemeAuthor" content="amuker(http://www.aiblogs.cn)">
    <meta name="keywords" content="<? echo $this->params['title']; ?>,个人博客,php,博客日记,网站建设,优化技巧" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>--<? echo $this->params['title']; ?>-建立自己的个人自媒体博客</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;url=../views/site/ie.html">
    <![endif]-->
    <?php $this->head() ?>
    <meta name="baidu-site-verification" content="fT0ogtK9qJ" />
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => 'My Blog',
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-fixed-top navbar navbar-inner',
//        ],
//    ]);
//    $menuItems = [
//        ['label' => '首页', 'url' => ['/site/index'],],
//        ['label' => '关于我们', 'url' => ['/site/about']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
//    ];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
//        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
//    } else {
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                '退出 (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link']
//            )
//            . Html::endForm()
//            . '</li>';
//    }
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => $menuItems,
//    ]);
//    NavBar::end();
//    ?>

    <nav class="navbar-fixed-top navbar navbar-inner" role="navigation">
        <div class="container-fluid  container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<? echo Yii::$app->homeUrl?>"><? echo $this->params['title']; ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <? foreach($this->params['menu'] as $menu):?>
                    <? $lists=\common\models\Frontmenu::find()->where(['parentid'=>$menu->id])->all()?>
                        <?php if (empty($lists)) : ?>
                            <li><a href="<? echo Url::to([$menu->route,'id'=>$menu->id])?>"><? echo $menu->title;?></a></li>
                        <?php else : ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo $menu->title;?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <? foreach($lists as $list):?>
                                        <li><a href="<?  echo Url::to([$list->route,'id'=>$list->id])?>"><? echo $list->title;?></a></li>
                                    <? endforeach;?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <? endforeach;?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left" role="search" action="<? echo Url::to(['search/search'])?>"  method="post">
                        <div class="input-group">
                          <input class="form-control" type="text" placeholder="搜些什么吧" name="search">
                          <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                        </div>
                    </form>
                    <? if(empty(Yii::$app->session['login_id'])):?>
                        <li><a href="<?echo Url::to(['site/login'])?>">QQ登录</a></li>
                    <? else: ?>
                        <li><a href="#"><? echo Yii::$app->session['login_user'];?></a></li>
                        <li><a href="<? echo Url::to(['site/logout'])?>">退出</a></li>
                    <? endif;?>

                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div class="col-lg-8 layout-left">
            <?= $content ?>
        </div>
        <div class="col-lg-4 main-right">
            <div class="list-group">
                <a href="#" class="list-group-item">
                    最新文章
                </a>
                <? foreach($this->params['newarticle'] as $newarticle):?>
                    <a href="<? echo Url::to(['article/show','id'=>$newarticle->id])?>" class="list-group-item"><span class="glyphicon glyphicon-chevron-right"></span> <? echo $newarticle->title?></a>
                <?endforeach;?>
            </div>
            <? if($this->params['ad']!=''):?>
                <div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            广告
                        </a>
                       <div>

                       </div>
                    </div>
                </div>
            <? endif ?>
<!--            <div>-->
<!--                <div class="list-group">-->
<!--                    <a href="#" class="list-group-item">-->
<!--                    最新评论-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div>-->
<!--                <div class="list-group">-->
<!--                    <a href="#" class="list-group-item">-->
<!--                        友情链接-->
<!--                    </a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                    <a href="#" class="list-group-item"></a>-->
<!--                </div>-->
<!--            </div>-->
            <div>
                <div class="list-group tags">
                    <a href="#" class="list-group-item">
                        标签云
                    </a>
                    <div class="span">
                        <? foreach($this->params['tag'] as $tag):?>
                            <a href="<? echo Url::to(['search/search-use-tag','tag'=>$tag->tag])?>"><span class="label"><? echo $tag->tag?></span></a>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
<!--        </div>-->
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="col-sm-6 left">&copy; <? echo $this->params['title']; ?> <?= date('Y') ?> <? echo $this->params['icp']; ?></div>
        <div class="col-sm-6 right">站长统计 | <a href="http://www.aiblogs.cn/backend/web/index.php">博客管理</a></div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<!--百度统计-->
<!--<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?15e78f270ec752fae3d7e8c090df16a1";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>-->


<!--右侧标签颜色与晃动-->
<script type="text/javascript">
    $('.input-group-addon').click(function(){
        $('.navbar-form').submit();
    });
    $(document).ready(function () {
        var tagclass=['label-default','label-primary','label-success','label-info','label-warning','label-danger'];
        $('.tags span').each(function () {
            $(this).addClass(tagclass[Math.floor(Math.random()*6)]);
        });
    });
    $(".tags span").each(function(k,img){
        new JumpObj(img,15);//晃动幅度
        $(img).hover(function(){this.parentNode.parentNode.addclassName="hover"});
    });
</script>



<!--百度站内搜索
<script type="text/javascript">(function(){document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E'));var bdcs = document.createElement('script');bdcs.type = 'text/javascript';bdcs.async = true;bdcs.src = 'http://znsv.baidu.com/customer_search/api/js?sid=8003703580612802368' + '&plate_url=' + encodeURIComponent(window.location.href) + '&t=' + Math.ceil(new Date()/3600000);var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(bdcs, s);})();</script>
-->
