<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_online
 * @property integer $status
 * @property string $intro
 * @property integer $create_at
 */
class Goods extends \yii\db\ActiveRecord
{
    public static $onlineArr=['0'=>'否','1'=>'是'];
    public static $statusArr=['0'=>'隐藏','1'=>'显示'];
    public $images=[];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sn','category_id', 'brand_id', 'stock','market_price','shop_price', 'is_online', 'status','sort'], 'required'],
            [['category_id', 'brand_id', 'stock', 'is_online', 'status','sort'], 'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['name'], 'string', 'max' => 80],
            [['sn'], 'string', 'max' => 40],
            [['logo'], 'safe'],
            [['images'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '商品货号',
            'logo' => '商品图片',
            'images'=>'缩略图',
            'category_id' => '商品分类',
            'brand_id' => '商品品牌',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'is_online' => '是否上架',
            'status' => '状态',
            'sort' => '排序',
            'create_at' => '创建时间',
        ];
    }

    /**
     * 1对1，得到商品分类
     * @return \yii\db\ActiveQuery
     */
//    public function getCate()
//    {
//        return $this->hasOne(GoodsCategory::className(),['id'=>'category_id']);
//    }

    public function getCate()
    {
        return GoodsCategory::findOne($this->category_id);
    }

    /**
     * 1对1，得到商品品牌
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }

    /**
     * 系统内置时间行为
     * @return array
     */
    public function behaviors()
    {
        return [
            ['class'=>TimestampBehavior::className(),
                'attributes'=>[
                    self::EVENT_BEFORE_INSERT=>['create_at'],
                ]
            ],
        ];
    }

//    得到列表页显示的图片地址
    public function getImage()
    {
        if(substr($this->logo,0,7)=="http://"){
            return $this->logo;
        }else{
            return '@web/'.$this->logo;
        }
    }

}
