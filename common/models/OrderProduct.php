<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_product_sizes".
 *
 * @property string $id
 * @property string $product_size_id
 * @property string $quantity
 * @property string $sell_price
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size_id', 'product_id', 'quantity'], 'integer'],
            [['sell_price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'Product ID',
            'size_id' => 'Product Size ID',
            'quantity' => 'Quantity',
            'sell_price' => 'Sell Price',
        ];
    }
}
