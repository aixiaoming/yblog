<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;


/**
 * Site controller
 */
class ManagerController extends Controller
{

    public function actionIndex(){
        $user0= User::find()->where(['type'=>0])->all();
        $user1= User::find()->where(['type'=>1])->all();
//        print_r($user0);
        return $this->render('index',[
            'users0'=>$user0,
            'users1'=>$user1,
        ]);
    }

    public function actionAdd()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            print_r(Yii::$app->request->post());
            if($model->addmanager()){
                echo "和";
            }
        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }

    }
}
