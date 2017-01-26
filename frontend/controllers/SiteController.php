<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Qquser;
use common\models\Website;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
		//var_dump(json_decode(str_replace('\"','"', $_COOKIE['on_login']),true));
		
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
        if (!$olduser=$quser->is_new($openid)){
            if(!$newuser=$quser->singup($openid,$rec)){
                Yii::$app->session->setFlash('error','登录失败');
                $this->redirect(['site/index']);
                Yii::$app->end();
            }else{
                $session=Yii::$app->getSession();
                $session->set('login_id',$quser->getid($openid));
                $session->set('login_user',$rec['nickname']);
            }
        }else{
            $session=Yii::$app->getSession();
            $session->set('login_id',$olduser->id);
            $session->set('login_user',$olduser->username);

			//设置cookie 保持长时间登录
            $identityCookie = ['name' => 'on_login', 'httpOnly' => true];
            $cookie = new Cookie($identityCookie);
            $cookie->value = json_encode([
                $olduser->id,
                $olduser->username,
                3600*24*30,
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $cookie->expire = time() + 3600*24*30;
            Yii::$app->getResponse()->getCookies()->add($cookie);

        }




        Yii::$app->session->setFlash('success','登录成功');
        $this->redirect(['site/index']);
        Yii::$app->end();
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        if(isset(Yii::$app->session['login_id']) && Yii::$app->session['login_user']){
            $this->redirect(['site/index']);
        }
        unset(Yii::$app->session['login_id']);
        unset(Yii::$app->session['login_user']);
        Yii::$app->session->setFlash('success','退出成功');

        $this->redirect(['site/index']);
        Yii::$app->end();
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

//array(18) {
//    ["ret"]=> int(0) ["msg"]=> string(0) "" ["is_lost"]=> int(0) ["nickname"]=> string(27) "第一个网名是啥来着" ["gender"]=> string(3) "男" ["province"]=> string(6) "河南" ["city"]=> string(6) "洛阳" ["year"]=> string(4) "1995" ["figureurl"]=> string(73) "http://qzapp.qlogo.cn/qzapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/30" ["figureurl_1"]=> string(73) "http://qzapp.qlogo.cn/qzapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/50" ["figureurl_2"]=> string(74) "http://qzapp.qlogo.cn/qzapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/100" ["figureurl_qq_1"]=> string(69) "http://q.qlogo.cn/qqapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/40" ["figureurl_qq_2"]=> string(70) "http://q.qlogo.cn/qqapp/101381338/DBF7135BC86C14AE6B11BB42EFE847C6/100" ["is_yellow_vip"]=> string(1) "0" ["vip"]=> string(1) "0" ["yellow_vip_level"]=> string(1) "0" ["level"]=> string(1) "0" ["is_yellow_year_vip"]=> string(1) "0" }