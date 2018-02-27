<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

$this->title = 'Sửa Khách Hàng: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Khách Hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="product-update">
    <div class="panel panel-info">
        <div class="panel-heading"><h4><?= Html::encode($this->title) ?></h4></div>
        <div class="panel-body">
            <div class="col-md-12">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'customer-form',
                    'action' => Url::to(['customer/update/', 'id' => $model->id]),
                    'method' => 'POST',
                ]) ?>
                <?= $form->field($model, 'name')->label('Họ Tên') ?>
                <?= $form->field($model, 'phone')->label('Số Điện Thoại') ?>
                <?= $form->field($model, 'facebook') ?>
                <?= $form->field($model, 'address')->label('Địa Chỉ') ?>
                <?= $form->field($model, 'ward')->label('Phường/Xã') ?>
                <?= $form->field($model, 'district')->label('Quận/Huyện') ?>
                <?= $form->field($model, 'city')->label('Thành Phố') ?>

                <div class="form-group">
                    <?= Html::submitButton('Cập Nhật', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>