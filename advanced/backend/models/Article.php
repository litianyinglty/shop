<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $author
 * @property string $intro
 * @property integer $sort
 * @property integer $status
 * @property integer $insert_time
 */
class Article extends \yii\db\ActiveRecord
{
//    设置属性
    public static $statusArray=['0'=>'隐藏','1'=>'显示'];
    /**
     * 返回真实表名
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * 设置规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','author','cate_id','intro','sort','status'],'required'],
            [['sort',], 'integer'],
            [['name'], 'string', 'max' => 60],
            [['author'], 'string', 'max' => 30],
            [['up_author'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * 设置lable
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'author' => '作者',
            'up_author' => '修改作者',
            'intro' => '简介',
            'cate_id'=>'文章分类',
            'sort' => '排序',
            'status' => '状态',
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
                    self::EVENT_BEFORE_INSERT=>['insert_time','update_time'],
                    self::EVENT_BEFORE_UPDATE=>['update_time'],
                ]
            ],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(ArticleCate::className(),['id'=>'cate_id']);
    }
}
