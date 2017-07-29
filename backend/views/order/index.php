<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Mari Na Shop - Đơn Hàng';
?>

<div class="container">
    <a class="pull-right btn btn-primary" href="<?= Url::to(['order/create']) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
         Thêm Đơn Hàng Mới</a>
</div>
<br>
<br>
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

