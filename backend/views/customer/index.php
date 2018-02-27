<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\StringHelper;

$this->title = 'Khách Hàng';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tạo khách hàng mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
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
</div>
