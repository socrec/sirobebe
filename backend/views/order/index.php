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
                'label' => 'Số Tiền'
            ],
            [
                'attribute' => 'shipping_fee',
                'format' => 'text',
                'label' => 'Phí Ship'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
            ]
        ],
    ]);
    ?>
</div>

