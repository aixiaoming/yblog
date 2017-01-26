<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\Frontmenu;
use yii;
use yii\web\Cookie;

class BaseController extends yii\web\Controller{

    public function init()
    {
		//if(isset($_COOKIE['onlogin']))
        $menu = Frontmenu::find()->where(['parentid'=>0])->all();
        $this->view->params['menu'] = $menu;

        $newarticle = Article::find()->where(['issee'=>1])->orderBy('createtime DESC')->limit(5)->all();
        $this->view->params['newarticle'] = $newarticle;

        $ad=\common\models\Website::find()->where(['englishtype'=>"site-ad"])->one()->content;
        $this->view->params['ad'] = $ad;

        $title=\common\models\Website::find()->where(['englishtype'=>'site-title'])->one()->content;
        $this->view->params['title'] = $title;

        $icp=\common\models\Website::find()->where(['englishtype'=>'site-icp'])->one()->content;
        $this->view->params['icp'] = $icp;

        $tag=Article::find()->distinct(true)->select(['tag'])->where(['issee'=>1])->limit(30)->all();
        $this->view->params['tag'] = $tag;
    }

}