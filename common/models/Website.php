<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "website".
 *
 * @property integer $id
 * @property string $type
 * @property string $content
 */
class Website extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'website';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required','on'=>['type']],
            [['content'], 'required','on'=>['']],
            [['type'], 'string', 'max' => 32,'on'=>['type']],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类目',
            'content' => '内容',
        ];
    }

    public function saveType($data){
        $this->scenario="type";
        if($this->load($data) && $this->validators){
            $this->save(false);
            return true;
        }
        return false;
    }

    public function saveContent($datas){
        foreach($datas as $key=>$value){
            $connection = Yii::$app->db;
            $connection->open();
            $command = $connection->createCommand("Update website SET content='$value' WHERE type=$key");
            $command->execute();
        }
    }
}
