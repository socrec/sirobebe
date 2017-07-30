<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property string $id
 * @property string $title
 * @property string $date
 * @property string $from
 * @property string $type
 * @property string $gender
 * @property string $style_id
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    public $images;
    public $styles;
    public $size;
    public $quantity;
    public $min_weight;
    public $max_weight;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'from'], 'string', 'max' => 300],
            [['type'], 'string', 'max' => 200],
            [['gender'], 'string', 'max' => 10],
            [['date'], 'safe'],
            [['size', 'quantity', 'max_weight', 'min_weight', 'styles'], 'required'],
            [['list_price', 'import_price'], 'number'],
            [['images'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tên Sản Phẩm',
            'date' => 'Ngày Nhập Hàng',
            'from' => 'Nguồn Nhập Hàng',
            'type' => 'Loại Hàng',
            'gender' => 'Giới Tính',
            'styles' => 'Kiểu Dáng',
            'images' => 'Ảnh Sản Phẩm',
            'import_price' => 'Giá Nhập Vào',
            'list_price' => 'Giá Bán Ra',
            'style_id' => 'Style ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            return true;
        } else {
            return false;
        }
    }

    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    public function getProductSizes()
    {
        return $this->hasMany(ProductSize::className(), ['product_id' => 'id']);
    }
}
