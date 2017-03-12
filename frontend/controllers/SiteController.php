<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Qquser;
use common\models\Website;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\Pagination;
use \common\helps\Helpfun;
use yii\web\Cookie;



/**
 * Site controller
 */
class SiteController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //qq登录手机版的地址是首页，不知道啥原因，所以要调转
        $helpfun = new Helpfun();
        if($helpfun->is_Mobile()){
            $code = Yii::$app->request->get("code");
            $state = Yii::$app->request->get("state");
            if (isset($code) && isset($state)){
                $this->redirect(['site/qqlogin','code'=>$code,'state'=>$state]);
                Yii::$app->end();
            }
        }



        $articles = Article::find()->where(['issee'=>1])->orderBy('createtime DESC');
        $count = $articles->count();
        $pageSize = Yii::$app->params['pageSize']['site'];
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
        $articles = $articles->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index',
        [
            'articles'=>$articles,
            'pager' => $pagination,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        require_once("../../vendor/qqlogin/qqConnectAPI.php");
        $qc = new \QC();
        $qc->qq_login();
    }

    public function actionQqlogin(){
        require_once("../../vendor/qqlogin/qqConnectAPI.php");
        $auth = new \Oauth();
        $token=$auth->qq_callback();
        $openid=$auth->get_openid();
        $qc = new \QC($token,$openid);
        $rec=$qc->get_user_info();
        $quser = new Qquser();
        if (!$olduser=$quser->is_new($openid)){//判断是否为新用户
            if(!$newuser=$quser->singup($openid,$rec)){//判断新用户是否注册成功
                Yii::$app->session->setFlash('error','登录失败');
                $this->redirect(['site/index']);
                Yii::$app->end();
            }else{//新用户注册成功
                $session=Yii::$app->getSession();
                $session->set('login_id',$quser->getid($openid));
                $session->set('login_user',$rec['nickname']);
                $data = serialize ([$openid,$quser->getid($openid)]);
            }
        }else{//老用户
            $session=Yii::$app->getSession();
            $session->set('login_id',$olduser->id);
            $session->set('login_user',$olduser->username);
            $data = serialize ([$openid,$olduser->id]);
        }

        //设置cookie 保持长时间登录
        // 从"response"组件中获取cookie 集合(yii\web\CookieCollection)
        $cookies = Yii::$app->response->cookies;
        // 在要发送的响应中添加一个新的cookie
        $cookies->add(new Cookie([
            'name' => 'is_login',
            'value' =>$data,
            'expire' => time()+3600*24*30,
        ]));
        $quser->saveip(Yii::$app->session['login_id']);
        Yii::$app->session->setFlash('success','登录成功');
        //$this->redirect(['site/index']);
        $this->goBack();
        Yii::$app->end();
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        //判断是否存在session 如果存在就清除session与cookice 否则就调回首页
        if(isset(Yii::$app->session['login_id']) && isset(Yii::$app->session['login_user'])){
            //清除session
            unset(Yii::$app->session['login_id']);
            unset(Yii::$app->session['login_user']);
            $cookies = Yii::$app->response->cookies;
            //清除cookice
            unset($cookies['is_login']);
            Yii::$app->session->setFlash('success','退出成功');
            $this->redirect(['site/index']);
            Yii::$app->end();
        }else{
            $this->redirect(['site/index']);
        }
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model = Website::find()->where(['englishtype'=>'site-about'])->one();

        return $this->render('about',
        [
            'model'=>$model,
        ]
        );
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
