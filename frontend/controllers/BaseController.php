<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\Frontmenu;
use common\models\Qquser;
use yii;
use yii\web\Cookie;

class BaseController extends yii\web\Controller{

    public function init()
    {
        //先判断是否有session
        //检测是否有已登录的登录cookie
        // 从 "request"组件中获取cookie集合(yii\web\CookieCollection)
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('is_login')){
            if(empty(Yii::$app->Session['login_id'])){
                //将得到的cookice反序列化
                $login_user = unserialize($cookies->getValue('is_login', null));;
                $user = new Qquser();
                //验证cookie
                if ($newuser = $user->checklogincook($login_user)){
                    $session=Yii::$app->getSession();
                    $session->set('login_id',$newuser->id);
                    $session->set('login_user',$newuser->username);
                    $user->saveip($newuser->id);
                }
            }
        }

        $cache = Yii::$app->cache;
        $menu=$cache->get('menu');
        if ($menu){//如果有缓存
            $this->view->params['menu'] = $menu;
        }else{//如果没有缓存，就创建
            $menu = Frontmenu::find()->where(['parentid'=>0])->all();
            $this->view->params['menu'] = $menu;
            $cache->set('menu',$menu);
        }


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