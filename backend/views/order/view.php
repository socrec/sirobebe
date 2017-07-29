<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;

$this->title = 'Mari Na Shop - Đơn Hàng';
?>

<div class="container">
    <button class="btn btn-warning pull-left " onclick="print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> In Hóa Đơn</button>
    <a class="pull-right btn btn-default" href="<?= Url::to(['order/index']) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
         Quay Lại</a>
    <a class="pull-right btn btn-warning" href="<?= Url::to(['order/update/', 'id' => $model->id]) ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        Sửa</a>
</div>
<br>
<br>
<div id="print-area">
<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'Mã Đơn Hàng',
            'format' => 'raw',
            'value' =>  str_pad($model->id, 5, '0', STR_PAD_LEFT)
        ],
        [
            'label' => 'Khách Hàng',
            'format' => 'raw',
            'value' =>  Html::a($model->customer->name, Url::to(['customer/view', 'id' => $model->customer_id]), [
                'target' => '_blank'
            ])
        ],
        [
            'label' => 'SĐT',
            'format' => 'raw',
            'value' => $model->customer->phone
        ],
        [
            'label' => 'Địa Chỉ',
            'format' => 'raw',
            'value' =>  $model->customer->address
        ],
        [
            'label' => 'Phường/Xã',
            'format' => 'raw',
            'value' =>  $model->customer->ward
        ],
        [
            'label' => 'Quận/Huyện',
            'format' => 'raw',
            'value' =>  $model->customer->district
        ],
        [
            'label' => 'Thành Phố',
            'format' => 'raw',
            'value' =>  $model->customer->city
        ],
        [
            'label' => 'Tiền Hàng',
            'format' => 'raw',
            'value' => '<b>' . number_format($model->total) . 'đ</b>',
        ],
        [
            'label' => 'Phí Ship',
            'format' => 'raw',
            'value' => '<b>' . number_format($model->shipping_fee).'đ</b>',
        ],
        [
            'label' => 'Ghi Chú',
            'format' => 'raw',
            'value' => nl2br($model->memo)
        ],
    ],
]);
?>
</div>
<script>
//    $(function () {
//        function print() {
//            var mode = 'iframe'; //popup
//            var close = mode == "popup";
//            var options = { mode : mode, popClose : close};
//            $("#order").printArea( { mode : 'iframe', popClose : false} );
//        }
//    })
</script>