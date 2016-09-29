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
        $user0= User::find()->where(['type'=>0])->all();
        $user1= User::find()->where(['type'=>1])->all();

        $query = Article::find()->where(['status' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


//        print_r($user0);
        return $this->render('index',[
            'users0'=>$user0,
            'users1'=>$user1,
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
}
