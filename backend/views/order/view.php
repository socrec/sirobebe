<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;

$this->title = str_pad($model->id, 6, '0', STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'Đơn Hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        &nbsp;<?= Html::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc muốn xóa đơn hàng này?',
                'method' => 'post',
            ],
        ]) ?>
        <button class="btn btn-warning pull-left " onclick="print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> In Hóa Đơn</button>
    </p>

    <div id="print-area">
        <?php
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' => 'Mã Đơn Hàng',
                    'format' => 'raw',
                    'value' => $this->title
                ],
                [
                    'label' => 'Khách Hàng',
                    'format' => 'raw',
                    'value' => $model->customer->name
                ],
                [
                    'label' => 'SĐT',
                    'format' => 'raw',
                    'value' => $model->customer->phone
                ],
                [
                    'label' => 'Địa Chỉ',
                    'format' => 'raw',
                    'value' => $model->customer->address
                ],
                [
                    'label' => 'Phường/Xã',
                    'format' => 'raw',
                    'value' => $model->customer->ward
                ],
                [
                    'label' => 'Quận/Huyện',
                    'format' => 'raw',
                    'value' => $model->customer->district
                ],
                [
                    'label' => 'Thành Phố',
                    'format' => 'raw',
                    'value' => $model->customer->city
                ],
                [
                    'label' => 'Ghi Chú',
                    'format' => 'raw',
                    'value' => nl2br($model->memo)
                ],
            ],
        ]);
        ?>
        <table id="w0" class="table table-striped table-bordered detail-view">
            <thead>
                <th class="text-center">STT</th>
                <th>Sản phẩm</th>
                <th class="text-right">Đơn giá</th>
                <th class="text-right">Số lượng</th>
                <th class="text-right">Thành tiền</th>
            </thead>
            <tbody>
                <?php foreach ($model->products as $index => $orderProduct) : ?>
                    <tr>
                        <td class="text-center"><?= ++$index ?></td>
                        <td><?= $orderProduct->product->title . ' - Size: ' . $orderProduct->size->size  ?></td>
                        <td class="text-right"><?= number_format($orderProduct->list_price) ?>đ</td>
                        <td class="text-right"><?= number_format($orderProduct->quantity) ?></td>
                        <td class="text-right"><?= number_format($orderProduct->quantity * $orderProduct->list_price) ?>đ</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="text-center"><?= ++$index ?></td>
                    <td colspan="3">Phí ship</td>
                    <td class="text-right"><?= number_format($model->shipping_fee) ?>đ</td>
                </tr>
                <tr>
<!--                    <td class="text-center">--><?//= ++$index ?><!--</td>-->
                    <td class="text-center" colspan="4">Tổng cộng</td>
                    <td class="text-right"><?= number_format($model->total) ?>đ</td>
                </tr>
            </tbody>
        </table>
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
</div>