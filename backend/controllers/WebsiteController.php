<?php

namespace backend\controllers;

use common\models\Website;
use Yii;
use yii\data\ActiveDataProvider;



class WebsiteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Website();
        $lists = Website::find()->where(['isinput'=>1])->all();

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

        $dataProvider = new ActiveDataProvider([
            'query' => Website::find()->where(['isinput'=>1]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        if(Yii::$app->request->isPost){
            $type=Yii::$app->request->post();
            if($model->saveType($type)){
                $this->redirect(['website/add']);
            }
        }

        return $this->render('add',
            [
                'model'=>$model,
                'dataProvider'=>$dataProvider,
            ]);
    }

    public function actionUpdate(){

        $id=Yii::$app->request->get();

        $model = Website::find()->where(['id'=>$id])->one();

        if($model->isinput==1){

            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                if ($model->load($post) && $model->save()) {
                    Yii::$app->session->setFlash('info', '修改成功');
                    $this->redirect(['website/add']);
                    Yii::$app->end();
                }
            }


            return $this->render('update',[
                'model'=>$model,
            ]);

        }elseif($model->isinput==0){

            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                if ($model->load($post) && $model->save()) {
                    $this->redirect(['website/other']);
                }
            }

            return $this->render('updateother',[
                'model'=>$model,
            ]);

        }


    }

    public function actionDelete()
    {
        $id = yii::$app->request->get();
        if($id!='' && !is_numeric($id)){
            if(Website::deleteAll(['id'=>$id])){
                yii::$app->session->setFlash('info','删除成功');
                $this->redirect(['website/add']);
                yii::$app->end();
            }
        }
        yii::$app->session->setFlash('danger','删除失败');
        $this->redirect(['website/add']);
        yii::$app->end();
    }


    public function actionOther()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Website::find()->where(['isinput'=>0]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('other',
            [
                'dataProvider'=>$dataProvider,
            ]);
    }

    public function actionAbout(){
        $model = Website::find()->where(['id'=>12])->one();
    }

}
