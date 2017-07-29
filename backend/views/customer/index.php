<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$this->title = 'Mari Na Shop - Khách Hàng';
?>

<div class="container">
    <a class="pull-right btn btn-primary" href="<?= Url::to(['customer/create']) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
         Thêm khách hàng mới</a>
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
            'attribute' => 'name',
            'format' => 'text',
            'label' => 'Họ Tên'
        ],
        [
            'attribute' => 'phone',
            'format' => 'text',
            'label' => 'Số Điện Thoại'
        ],
//        [
//            'format' => 'raw',
//            'attribute' => 'facebook',
//            'value' => function ($model) {
//                return Html::a(StringHelper::truncate($model->facebook, 30), $model->facebook, [
//                    'target' => '_blank'
//                ]);
//            }
//        ],
        [
            'attribute' => 'address',
            'format' => 'raw',
            'label' => 'Địa Chỉ',
            'value' => function ($model) {
                return StringHelper::truncate($model->address, 50);
            }
        ],
        [
            'attribute' => 'ward',
            'format' => 'text',
            'label' => 'Phường/Xã'
        ],
        [
            'attribute' => 'district',
            'format' => 'text',
            'label' => 'Quận/Huyện'
        ],
        [
            'attribute' => 'city',
            'format' => 'text',
            'label' => 'Thành Phố'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
//            'buttons' => function ($url, $model, $key) {
//                dd($url, $model, $key);
//            }
        ]
    ],
]);
?>

