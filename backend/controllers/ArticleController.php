<?php

namespace backend\controllers;

use yii;
use yii\web\Controller;
use common\models\Article;
use yii\web\UploadedFile;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;




class ArticleController extends Controller
{
    public function actionAdd()
    {
        $model = new Article();
        if(Yii::$app->request->isPost){
            try{
                $model->img= UploadedFile::getInstance($model, 'img');
                $filename=time().rand(1000,9999);
                $filepath='../web/upload/img/faceimg/'.$filename.'.'.$model->img->extension;
                if (!$model->img->saveAs($filepath)) {
                    throw new \Exception('封面图片添加失败！');
                }else{
                    if($model->load(Yii::$app->request->post())){
                        $model->img=$filepath;
                        $model->createtime=time();
//                        $this->redirect(['article/index']);
                        if( $model->save()){
                            yii::$app->session->setFlash('info','修改成功');
                            $this->redirect(['article/index']);
                          }else{
                            var_dump($model->getErrors());
                        }
                    }
                }
            }catch( \Exception $e){
                Yii::$app->session->setFlash('danger', $e->getMessage());
            }
        }
        return $this->render('add',
            ['model'=>$model]);
    }

    public function actionDel()
    {
        return $this->render('del');
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
            'pagination' => [
            'pageSize' => 15,
            ],
        ]);

        return $this->render('index',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
