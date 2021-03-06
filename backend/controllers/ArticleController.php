<?php

namespace backend\controllers;

use common\models\search\ArticleSearch;
use yii;
use yii\web\Controller;
use common\models\Article;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;




class ArticleController extends BaseController
{
    public function actionAdd()
    {
        $this->layout='mainart.php';
        $model = new Article();
        $model->loadDefaultValues();
        if(Yii::$app->request->isPost){
            try{
                $model->img= UploadedFile::getInstance($model, 'img');
                $filename=time().rand(1000,9999);
                $filepath='../../upload/articleimg/'.$filename.'.'.$model->img->extension;
                if (!$model->img->saveAs($filepath)) {
                    throw new \Exception('封面图片添加失败！');
                }else{
                    if($model->load(Yii::$app->request->post())){
                        $model->img=$filepath;
                        $model->createtime=time();
                        $model->abstract=htmlspecialchars($model->abstract);
//                        $this->redirect(['article/index']);
                        if( $model->save()){
                            yii::$app->session->setFlash('info','发布成功');
                            $this->redirect(['article/index']);
                            yii::$app->end();
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

    public function actionDelete()
    {
        $id = yii::$app->request->get();
        if($id!='' && !is_numeric($id)){
            if(unlink(Article::find()->where(['id'=>$id])->one()->img) && Article::deleteAll(['id'=>$id])){
                yii::$app->session->setFlash('info','删除成功');
                $this->redirect(['article/index']);
                yii::$app->end();
            }
        }
        yii::$app->session->setFlash('danger','删除失败');
        $this->redirect(['article/index']);
        yii::$app->end();
    }

    public function actionIndex()
    {
		$this->layout='mainart.php';
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->orderBy('createtime DESC'),
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
        $this->layout='mainart.php';
        $id = yii::$app->request->get();
        $model = Article::find()->where(['id'=>$id])->one();
        $oldimg=$model->img;
        if( yii::$app->request->isPost){
            $img=$model->img= UploadedFile::getInstance($model, 'img');
            if($img==null){
                if($model->load(Yii::$app->request->post())){
                    $model->img=$oldimg;
                    $model->abstract=htmlspecialchars($model->abstract);
                    if( $model->save()){
                        yii::$app->session->setFlash('info','修改成功');
                        $this->redirect(['article/index']);
                        yii::$app->end();
                    }
                }
            }else{
                unlink($oldimg);
                $filename=time().rand(1000,9999);
                $filepath='../../upload/articleimg/'.$filename.'.'.$model->img->extension;
                if (!$model->img->saveAs($filepath)) {
                    throw new \Exception('封面图片添加失败！');
                }
                if($model->load(Yii::$app->request->post())){
                    $model->img=$filepath;
                    $model->abstract=htmlspecialchars($model->abstract);
                    if( $model->save()){
                        yii::$app->session->setFlash('info','修改成功');
                        $this->redirect(['article/index']);
                        yii::$app->end();
                    }
                }
            }
        }
        $model->abstract=htmlspecialchars_decode($model->abstract);
        return $this->render('update',
            ['model'=>$model]
        );
    }

}
