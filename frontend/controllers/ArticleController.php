<?php

namespace frontend\controllers;

use frontend\controllers\BaseController;
use common\models\Article;
use Yii;
use yii\data\Pagination;

class ArticleController extends BaseController
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

    public function actionFind(){
        $menuid=Yii::$app->request->get("id");
        $articles = Article::find()->where(['issee'=>1,'menuid'=>$menuid])->orderBy('createtime DESC');
        $count = $articles->count();
        $pageSize = Yii::$app->params['pageSize']['article'];
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
        $articles = $articles->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('find',
            [
                'articles'=>$articles,
                'pager' => $pagination,
            ]);
    }



}
