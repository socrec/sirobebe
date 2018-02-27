<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Khách Hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc muốn xóa khách hàng này?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
                'value' => Html::a($model->facebook, $model->facebook, [
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
</div>
