<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qquser".
 *
 * @property integer $id
 * @property string $openid
 * @property string $username
 * @property integer $status
 * @property string $lastip
 * @property integer $created_at
 * @property integer $updated_at
 */
class Qquser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qquser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['status', 'created_at'], 'integer'],
            [['username'], 'string', 'max' => 150],
            [['lastip'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '昵称',
            'status' => 'Status',
            'lastip' => '登陆IP',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 判断是否新用户
     */
    public function is_new($openid){
        $user = self::findOne(['openid'=>$openid]);
        if (empty($user)){
            return false;
        }else{
            return $user;
        }
    }


    public function singup($openid,$rec){
        $this->openid=$openid;
        $this->username=$rec['nickname'];
        $this->status=10;
        $this->created_at=time();
        return $this->save()?true:false;
    }

    /**
     *根据openID得到id
     */
    public function getid($openid){
        return self::findOne(['openid'=>$openid])->id;
    }
}
