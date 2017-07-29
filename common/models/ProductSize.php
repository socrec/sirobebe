<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_sizes".
 *
 * @property string $id
 * @property string $product_id
 * @property integer $size
 * @property string $quantity
 * @property integer $min_weight
 * @property integer $max_weight
 * @property string $list_price
 * @property string $import_price
 */
class ProductSize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_sizes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'size', 'quantity', 'min_weight', 'max_weight'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'size' => 'Size',
            'quantity' => 'Quantity',
            'min_weight' => 'Min Weight',
            'max_weight' => 'Max Weight',
            'list_price' => 'List Price',
            'import_price' => 'Import Price',
        ];
    }
}
