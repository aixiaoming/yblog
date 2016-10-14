<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp"/>
        <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
        <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <?php $this->beginBody() ?>
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="../web/css/profile_small.jpg"/></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">Beaut-zihan</strong></span>
                                <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                                </li>
                                <li><a class="J_menuItem" href="profile.html">个人资料</a>
                                </li>
                                <li><a class="J_menuItem" href="contacts.html">联系我们</a>
                                </li>
                                <li><a class="J_menuItem" href="mailbox.html">信箱</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="login.html">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">H+
                        </div>
<!--                    </li>-->
                    <li class="<? if(Yii::$app->controller->getRoute()=='site/index'){echo "active";};?>">
                        <a href="<? echo Url::to(['site/index'])?>">主页</a>
                    </li>
                    <li class="<? if(Yii::$app->controller->getRoute()=='website/index'){echo "active";};?>">
                        <a href="<? echo Url::to(['website/index'])?>">网站管理</a>
                    </li>
                    <li class="<? if(Yii::$app->controller->getRoute()=='article/index'){echo "active";};?>">
                        <a href="<? echo Url::to(['article/index'])?>">文章</a>
                    </li>
                    <li class="<? if(Yii::$app->controller->getRoute()=='manager/index'){echo "active";};?>">
                        <a href="<? echo Url::to(['manager/index'])?>">会员管理</a>
                    </li>
                    <li class="<? if(Yii::$app->controller->getRoute()=='frontmenu/index'){echo "active";};?>">
                        <a href="<? echo Url::to(['frontmenu/index'])?>">前台分类</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search"
                                       id="top-search">
                            </div>
                        </form>
                    </div>

                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="login.html" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 2014-2015 <a href="http://www.zi-han.net/" target="_blank">zihan's
                        blog</a>
                </div>
            </div>
        </div>
    </div>
    <link href="../web/css/bootstrap.min.css" rel="stylesheet">
    <link href="../web/css/font-awesome.min.css" rel="stylesheet">
    <link href="../web/css/animate.min.css" rel="stylesheet">
    <link href="../web/css/style.min.css" rel="stylesheet">
    <link href="../web/css/main.css" rel="stylesheet">
    <script src="../web/js/jquery.min.js?v=2.1.4"></script>
    <script src="../web/js/bootstrap.min.js?v=3.3.5"></script>
<!--    <script src="../web/js/plugins/metisMenu/jquery.metisMenu.js"></script>-->
<!--    <script src="../web/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>-->
<!--    <script src="../web/js/plugins/layer/layer.min.js"></script>-->
<!--    <script src="../web/js/hplus.min.js?v=4.0.0"></script>-->
<!--    <script type="text/javascript" src="../web/js/contabs.min.js"></script>-->
<!--    <script src="../web/js/plugins/pace/pace.min.js"></script>-->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>