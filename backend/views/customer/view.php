<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;

$this->title = 'Mari Na Shop - Khách Hàng';
?>

<div class="container">
    <a class="pull-right btn btn-default" href="<?= Url::to(['customer/index']) ?>"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
         Quay Lại</a>
    <a class="pull-right btn btn-warning" href="<?= Url::to(['customer/update/', 'id' => $model->id]) ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
         Sửa</a>
</div>
<br>
<br>
<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'Họ Tên',
            'value' => $model->name,
        ],
        [
            'label' => 'Số Điện Thoại',
            'value' => $model->phone,
        ],
        [
            'label' => 'Facebook',
            'format' => 'raw',
            'value' =>  Html::a($model->facebook, $model->facebook, [
                'target' => '_blank'
            ])
        ],
        [
            'label' => 'Địa Chỉ',
            'value' => $model->address,
        ],
        [
            'label' => 'Phường/Xã',
            'value' => $model->ward,
        ],
        [
            'label' => 'Quận/Huyện',
            'value' => $model->district,
        ],
        [
            'label' => 'Thành Phố',
            'value' => $model->city,
        ],
    ],
]);
?>

