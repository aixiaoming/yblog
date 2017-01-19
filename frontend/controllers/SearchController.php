<?php

namespace frontend\controllers;

use frontend\controllers\BaseController;
use common\models\Article;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class SearchController extends BaseController
{

    public $enableCsrfValidation = false;

    public function actionSearch(){


        if(Yii::$app->request->isPost){
            $search = Yii::$app->request->post();
            if(!empty($search)){
                $articles = Article::find()->where(['issee'=>1])->andFilterWhere(['like', 'title', $search['search']
                ])->orFilterWhere(['like', 'abstract', $search['search']
                ])->orderBy('createtime DESC');
                $count = $articles->count();
                $pageSize = Yii::$app->params['pageSize']['article'];
                $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
                $articles = $articles->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
                return $this->render('search',
                    [
                        'search'=>$search['search'],
                        'articles'=>$articles,
                        'pager' => $pagination,
                    ]);
            }else{
                $this->redirect(['site/index']);
            }
        }else{
            $this->redirect(['site/index']);
        }
    }

    public function actionSearchUseTag(){
        $tag=Yii::$app->request->get('tag');
        if(!empty($tag)){
            $articles = Article::find()->where(['issee'=>1,'tag'=>$tag])->orderBy('createtime DESC');
            $count = $articles->count();
            $pageSize = Yii::$app->params['pageSize']['article'];
            $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
            $articles = $articles->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            return $this->render('searchusetag',
                [
                    'tag'=>$tag,
                    'articles'=>$articles,
                    'pager' => $pagination,
                ]);
        }
    }
}
