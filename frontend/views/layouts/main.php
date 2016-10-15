<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;


AppAsset::register($this);
$this->registerJsFile('../../backend/web/js/jquery.min.js');
$this->registerJsFile('../../backend/web/js/bootstrap.min.js');
$this->registerCssFile('../web/css/main.css');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
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
                <a class="navbar-brand" href="<? echo Yii::$app->homeUrl?>"><? echo \common\models\Website::find()->where(['englishtype'=>'site-title'])->one()->content;?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <? foreach($this->params['menu'] as $menu):?>
                    <? $lists=\common\models\Frontmenu::find()->where(['parentid'=>$menu->id])->all()?>
                        <?php if (empty($lists)) : ?>
                            <li><a href="<? echo Url::to([$menu->route])?>"><? echo $menu->title;?></a></li>
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
                        <div class="form-group">
                            <input type="text" placeholder="搜些什么吧" name="search">
                        </div>
                        <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                    <li><a href="<?  echo Url::to(['site/login'])?>">登录</a></li>
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
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Blog <?= date('Y') ?></p>
        <p class="pull-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>