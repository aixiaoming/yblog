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
//                $articles = ArrayHelper::toArray( $articles);
//                var_dump($articles);
//                $articles = str_replace("解决","tihuan",$articles);
//                var_dump($articles);
                return $this->render('search',
                    [
                        'search'=>$search,
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
}
