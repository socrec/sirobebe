<?php
/**
 * Created by PhpStorm.
 * User: dangnh
 * Date: 6/12/2017
 * Time: 5:42 PM
 */

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderSearch extends Customer
{
    public $customer_name = '';
    public $total = '';
    public $shipping_fee = '';
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['customer_name', 'total', 'shipping_fee'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Order::find()->where(['orders.is_deleted' => 0])->joinWith('customer')->orderBy('orders.id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'customers.name', $this->customer_name])
            ->andFilterWhere(['like', 'total', $this->total])
            ->andFilterWhere(['like', 'shipping_fee', $this->shipping_fee]);

        return $dataProvider;
    }
}