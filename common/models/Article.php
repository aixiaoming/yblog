<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $Id
 * @property string $title
 * @property string tag
 * @property string keywords
 * @property string $abstract
 * @property string $content
 * @property string $img
 * @property integer $issee
 * @property integer $userid
 * @property integer $menuid
 * @property integer $issay
 * @property integer $isoriginal
 * @property integer $seenum
 * @property string $createtime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','abstract','content','issee','userid','menuid','issay','isoriginal'],'required'],
            [['content'], 'string'],
            [['issee', 'userid', 'menuid', 'issay', 'isoriginal', 'seenum'], 'integer'],
            [['title', 'img'], 'string', 'max' => 255],
            [['abstract'], 'string', 'max' => 500],
            [['tag','keywords'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'title' => '标题',
            'abstract' => '摘要',
            'content' => '内容',
            'img' => '封面图片',
            'issee' => '是否公开',
            'userid' => '作者',
            'menuid' => '所属分类',
            'issay' => '是否允许评论',
            'isoriginal' => '是否原创',
            'seenum' => '点击量',
            'createtime' => '发布时间',
            'tag' => '标签',
            'keywords' => 'SEO关键字',
        ];
    }
}
