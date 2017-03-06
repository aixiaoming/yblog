<?php

namespace frontend\controllers;

use common\models\Comments;
use common\helps\ValidateCode;
use Yii;

class CommentController extends BaseController
{
    public function init()
    {
        parent::init();
        if(empty(Yii::$app->Session['login_id'])){
           // Yii::$app->response->format=Response::FORMAT_JSON;
            $res=['statue'=>false,'message'=>"请先登录"];
            echo json_encode($res);
            Yii::$app->end();
        }
    }

    public function actionGetvalid(){
        $vc = new ValidateCode();  //实例化一个对象
        $vc->doimg();
        Yii::$app->session['com_valid'] = $vc->getCode();//验证码保存到SESSION中
    }



    /*
     * 插入评论 返回json数据
     */
    public function actionSave(){
        $con = Yii::$app->request->post();
        $comment = new Comments();
        if($comment->savecon($con)){
            $res=['statue'=>true,'message'=>"评论成功"];
            $res = array_merge($res,$con);
            echo json_encode($res);
        }else{
            $res=['statue'=>true,'message'=>"chaq"];
            $res = array_merge($res,$con);
            echo json_encode($res);
        }
    }

    /**
     * 验证码
     * @return array
     */



}
