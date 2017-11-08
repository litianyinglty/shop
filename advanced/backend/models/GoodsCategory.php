<?php

namespace backend\models;

use backend\components\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $parent_id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','parent_id','intro'], 'required'],
            [['parent_id', 'tree', 'lft', 'rgt', 'depth'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'intro' => '简介',
            'parent_id' => '父ID',
            'tree' => '树',
            'lft' => '左值',
            'rgt' => '右值',
            'depth' => '深度',
        ];
    }

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
                 'leftAttribute' => 'lft',
                 'rightAttribute' => 'rgt',
                 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {

        return new MenuQuery(get_called_class());
    }

    public function getNameText()
    {
        return str_repeat('...',3*$this->depth).$this->name;

    }
}
