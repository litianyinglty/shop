<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $memberId
 * @property string $name
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $address
 * @property string $tel
 * @property integer $status
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'province', 'city', 'county', 'address', 'tel'], 'required'],
            [['id', 'member_id','status'], 'integer'],
            [['province', 'city', 'county'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 255],
            [['tel'],'match','pattern'=>'/^(13|14|15|17|18)[0-9]{9}$/','message'=>'手机号不正确'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'member_id' => 'Member ID',
            'name' => '收货人姓名',
            'province' => '省份',
            'city' => '市',
            'county' => '区县',
            'address' => '收货人地址',
            'tel' => '手机号',
            'status' => '状态',
        ];
    }
}
