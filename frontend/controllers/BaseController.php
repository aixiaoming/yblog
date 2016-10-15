<?php

namespace frontend\controllers;

use common\models\Frontmenu;
use yii;

class BaseController extends yii\web\Controller{

    public function init()
    {
        $menu = Frontmenu::find()->where(['parentid'=>0])->all();
        $this->view->params['menu'] = $menu;
    }

}