<?php
/**
 * Created by PhpStorm.
 * User: zhao晓明
 * Date: 2016/10/3
 * Time: 21:35
 */

namespace backend\controllers;

use Yii;
use common\models\Frontmenu;
use yii\web\Controller;

class FrontmenuController extends BaseController{

    public function actionIndex()
    {
        $this->layout='mainart.php';
        $model = new Frontmenu();
        $list= $model->getTreeList();
        return $this->render('index',
        ['lists'=>$list]);
    }


    public function actionAdd()
    {
        $model = new Frontmenu();
//        $list1 = $model->getDatas();
        $list = $model->getOptions();
//        $list1=$model->getdata();
//        var_dump($list1);
//        var_dump($list);
//        var_dump(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['frontmenu/index']);
        }
        return $this->render("add", ['list' => $list, 'model' => $model]);
    }


    public function actionUpdate(){

        $id = Yii::$app->request->get("id");
        $model = Frontmenu::find()->where('id = :id', [':id' => $id])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('info', '修改成功');
                $this->redirect(['frontmenu/index']);
                Yii::$app->end();
            }
        }
        $list = $model->getOptions();
        return $this->render('update', ['model' => $model, 'list' => $list]);
    }


    public function actionDelete(){
        try {
            $id = Yii::$app->request->get('id');
            if (empty($id)) {
                throw new \Exception('参数错误');
            }
            $data = Frontmenu::find()->where('parentid = :pid', [":pid" => $id])->one();
            if ($data) {
                throw new \Exception('该分类下有子类，不允许删除');
            }
            if (!Frontmenu::deleteAll('id = :id', [":id" => $id])) {
                throw new \Exception('删除失败');
            }
        } catch(\Exception $e) {
            Yii::$app->session->setFlash('info', $e->getMessage());
        }
        return $this->redirect(['frontmenu/index']);
    }

}