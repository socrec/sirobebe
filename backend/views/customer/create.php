<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Tạo Khách Hàng';
$this->params['breadcrumbs'][] = ['label' => 'Khách Hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">
    <div class="panel panel-info">
        <div class="panel-heading"><h4><?= Html::encode($this->title) ?></h4></div>
        <div class="panel-body">
            <div class="col-md-12">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'customer-form',
                    'action' => Url::to(['customer/create']),
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
                    <?= Html::submitButton('Tạo mới', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>