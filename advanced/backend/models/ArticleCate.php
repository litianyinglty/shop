<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article_cate".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $sort
 * @property integer $create_time
 */
class ArticleCate extends \yii\db\ActiveRecord
{
    public static $is_helpArr=['0'=>'否','1'=>'是'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_cate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','intro','sort'],'required'],
            [['sort'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['intro'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章分类名称',
            'intro' => '分类简介',
            'sort' => '分类排序',
            'is_help'=>'帮助',
        ];
    }

    /**
     * 系统内置时间行为
     * @return array
     */
    public function behaviors(){
        return [
            ['class'=>TimestampBehavior::className(),
                'attributes'=>[
                    self::EVENT_BEFORE_INSERT=>['create_time'],
                ]
            ],
        ];
    }

    public function getArticle()
    {
        return $this->hasMany(Article::className(),['cate_id'=>'id']);
    }
}
