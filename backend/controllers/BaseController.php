<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\controllers\SiteController;

/**
 * Site controller
 */
class BaseController extends Controller
{
    public function init(){
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/user/login']);
        }
    }

}
