<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Đơn Hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo đơn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'raw',
                'attribute' => 'customer_name',
                'label' => 'Khách Hàng',
                'value' => function ($model) {
                    return Html::a($model->customer->name, Url::to(['customer/view', 'id' => $model->customer_id]), [
                        'target' => '_blank'
                    ]);
                }
            ],
            [
                'attribute' => 'total',
                'format' => 'text',
                'label' => 'Số Tiền',
                'value' => function ($model) {
                    return number_format($model->total) . 'đ';
                }
            ],
            [
                'attribute' => 'shipping_fee',
                'format' => 'text',
                'label' => 'Phí Ship',
                'value' => function ($model) {
                    return number_format($model->shipping_fee) . 'đ';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ]
        ],
    ]);
    ?>
</div>

