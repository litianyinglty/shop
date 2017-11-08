<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
//    设置属性
    public static $statusArray=['-1'=>'隐藏','1'=>'显示'];
    //public $image;
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * 设置规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','intro','sort','status'],'required'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['intro'], 'string', 'max' => 255],
            [['logo'],'safe'],
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
            'intro' => '简介',
            'logo' => '图片',
            'sort' => '排序',
            'status' => '状态',
        ];
    }

    /**
     * 得到图片地址
     * @return string
     */
    public function getImage()
    {
        if(substr($this->logo,0,7)=="http://"){
            return $this->logo;
        }else{
            return '@web/'.$this->logo;
        }
    }
}
