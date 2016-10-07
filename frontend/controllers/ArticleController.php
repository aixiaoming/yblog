<?php

namespace frontend\controllers;
use common\models\Article;
use Yii;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShow()
    {
        $id=Yii::$app->request->get();
        $article=Article::find()->where(['id'=>$id])->one();
        return $this->render('show',
            ['article'=>$article]
        );
    }

}
