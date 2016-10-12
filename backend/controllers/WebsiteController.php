<?php

namespace backend\controllers;

use common\models\Website;
use Yii;

class WebsiteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Website();
        $lists = Website::find()->all();

        if(Yii::$app->request->isPost){
            $content=Yii::$app->request->post();
            $model->saveContent($content['Website']['content']);
                $this->redirect(['website/index']);
                yii::$app->end();
        }

        return $this->render('index',
            [
                'lists'=>$lists,
            ]);
    }

    public function actionAdd()
    {
        $model = new Website();
        if(Yii::$app->request->isPost){
            $type=Yii::$app->request->post();
            if($model->saveType($type)){
                $this->redirect(['website/add']);
            }
        }

        return $this->render('add',
            [
                'model'=>$model,
            ]);
    }

}
