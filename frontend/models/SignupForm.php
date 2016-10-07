<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password1;
    public $type;


    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
            'password1' => '确认密码',
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '此用户名已经注册！'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '此邮箱已经注册！'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],


            ['password1', 'required'],
            ['password1', 'string', 'min' => 6],
            ['password1', 'compare', 'compareAttribute' => 'password', 'operator' => '==='],

            ['type','required'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->type = $this->type;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

//    public function updatesave()
//    {
//        if (!$this->validate()) {
//            return null;
//        }
//
//        $user = User::find()->where(['id'=>$this->id]);
//        $user->email = $this->email;
//        $user->setPassword($this->password);
//
//        return $user->save() ? $user : null;
//    }
}
