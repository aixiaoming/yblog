<?php

namespace frontend\controllers;

use common\models\Comments;
use common\models\Reply;
use frontend\controllers\BaseController;
use common\models\Article;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ArticleController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShow()
    {

        //得到文章 浏览量+1
        $id=Yii::$app->request->get();
        $article=Article::find()->where(['id'=>$id])->one();
        $article->seenum=$article->seenum+1;
        $article->save();

        //评论
       /* $comment = new Comments();
        $article_comment = $comment->findArticleComment($id);
        $arr = new ArrayHelper();
        $article_comment = $arr->toArray($article_comment);*/

        //寻找评论的回复
       /* $replys = new Reply();
        $comments = [];
        foreach ($article_comment as $comment){
           $reply = $replys->findReplyByComent($comment['id']);
           if (empty($reply)){
               $reply = '';
           }else{
               $reply = $arr->toArray($reply);
           }
           $comment['reply'] = $reply;
           $comments[] = $comment;
        }*/
        return $this->render('show',
            [
                'article'=>$article,
                /*'comments'=>$comments,*/
            ]
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
