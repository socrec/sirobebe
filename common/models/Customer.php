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

class Customer extends ActiveRecord
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
        return '{{customers}}';
    }

    public function rules()
    {
        return [
            // the name, email, subject and body attributes are required
            [['name', 'phone', 'address', 'ward', 'district', 'city'], 'safe'],
            [['facebook'], 'string'],
        ];
    }
}