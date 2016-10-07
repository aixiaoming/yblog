<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "frontmenu".
 *
 * @property integer $Id
 * @property string $title
 * @property integer $parentid
 */
class Frontmenu extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frontmenu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid'], 'integer'],
            ['parentid','required' ],
            [['title'], 'string', 'max' => 255],
            ['title','required' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '分类名称',
            'parentid' => '上级分类',
        ];
    }

    public function getDatas(){
        $datas=self::find()->all();
        $datas=ArrayHelper::toArray($datas);
        return $datas;
    }

    public function getTree($datas, $pid = 0)
    {
        $tree = [];
        foreach($datas as $data) {
            if ($data['parentid'] == $pid) {
                $tree[] = $data;
                $tree = array_merge($tree, $this->getTree($datas, $data['id']));
            }
        }
        return $tree;
    }

    public function setPrefix($data, $p = "|-")
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while($val = current($data)) {
            $key = key($data);
            if ($key > 0) {
                if ($data[$key - 1]['parentid'] != $val['parentid']) {
                    $num ++;
                }
            }
            if (array_key_exists($val['parentid'], $prefix)) {
                $num = $prefix[$val['parentid']];
            }
            $val['title'] = str_repeat($p, $num).$val['title'];
            $prefix[$val['parentid']] = $num;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }

    public function getOptions()
    {
        $data = $this->getDatas();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        $options = ['添加顶级分类'];
        foreach($tree as $cate) {
            $options[$cate['id']] = $cate['title'];
        }
        return $options;
    }

    public function getTreeList()
    {
        $data = $this->getDatas();
        $tree = $this->getTree($data);
        return $tree = $this->setPrefix($tree);
    }


}
