<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 6/10/2017
 * Time: 5:37 PM
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Order extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => 1
                ],
                'replaceRegularDelete' => true
            ]
        ];
    }

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
            [['total', 'shipping_fee', 'status'], 'required'],
            [['memo', 'tracking_number'], 'string'],
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