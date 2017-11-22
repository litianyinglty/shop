<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $name
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $address
 * @property string $tel
 * @property integer $delivery_id
 * @property string $delivery_name
 * @property string $delivery_price
 * @property integer $pay_type_id
 * @property string $pay_name
 * @property string $price
 * @property integer $status
 * @property string $trade_no
 * @property integer $create_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'delivery_id', 'pay_type_id', 'status', 'create_at'], 'integer'],
            [['delivery_price','price'], 'number'],
            [['name','trade_no'], 'string', 'max' => 30],
            [['province', 'city', 'district', 'delivery_name'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 50],
            [['tel'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => '用户ID',
            'name' => '收货人',
            'province' => '省份',
            'city' => '城市',
            'district' => '区县',
            'address' => '详细地址',
            'tel' => '手机号',
            'delivery_id' => '送货方式ID',
            'delivery_name' => '配送方式名字',
            'delivery_price'=>'运费',
            'pay_type_id' => '支付方式',
            'pay_name' => '支付方式名字',
            'price' => '商品总额',
            'status' => '订单状态',
            'trade_no'=>'第三方订单号',
            'create_at' => '创建时间',
        ];
    }

    /**
     * 设置系统生成时间
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
}
