<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 6/10/2017
 * Time: 5:37 PM
 */

namespace common\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{orders}}';
    }

    public function rules()
    {
        return [
            [['total', 'shipping_fee'], 'required'],
            [['memo'], 'string'],
            [['customer_id'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'products' => 'Sản phẩm',
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }
}