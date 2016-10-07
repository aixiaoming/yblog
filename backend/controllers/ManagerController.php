<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use frontend\models\SignupForm;
use yii\data\Pagination;




/**
 * Site controller
 */
class ManagerController extends Controller
{

    public function actionIndex(){
        $user0= User::find()->where(['type'=>0]);
        $user1= User::find()->where(['type'=>1]);

        $countQuery0 = clone $user0;
        $pages0 = new Pagination(['totalCount' => $countQuery0->count(),'pagesize'=>5]);
        $models0 = $user0->offset($pages0->offset)
            ->limit($pages0->limit)
            ->all();

        $countQuery1 = clone $user1;
        $pages1 = new Pagination(['totalCount' => $countQuery1->count(),'pagesize'=>5]);
        $models1 = $user1->offset($pages1->offset)
            ->limit($pages1->limit)
            ->all();

        // print_r($user0);
        return $this->render('index',[
            'users0'=>$models0,
            'users1'=>$models1,
            'pages0' => $pages0,
            'pages1' => $pages1,
        ]);
    }

    public function actionAdd()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                yii::$app->session->setFlash('success','新增管理员成功。');
                $this->redirect(['manager/index']);
                Yii::$app->end();
            }
        }

        return $this->render('add', [
            'model' => $model,
        ]);

    }

    public function actionUpdate($id){
        print_r($id);
        $model=User::find()->where(['id'=>$id])->one();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            print_r($post);
            if ($model->updatesave($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
                $this->redirect(['manager/index']);
                Yii::$app->end();
            }
        }
        return $this->render('update',[
            'model'=>$model
        ]);
    }

    public function actionDelete($id){
        User::deleteAll(['id'=>$id]);
        Yii::$app->session->setFlash('info', '删除成功');
        $this->redirect(['manager/index']);
        Yii::$app->end();
    }
}


