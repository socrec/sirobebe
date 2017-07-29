<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

$this->title = 'Mari Na Shop - Khách Hàng';
?>

<div class="container">
    <a class="pull-right btn btn-default" href="<?= Url::to(['customer/index']) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
         Quay Lại</a>
</div>
<br>
<br>
<?php
$form = ActiveForm::begin([
    'id' => 'customer-form',
    'action' => Url::to(['customer/create']),
    'method' => 'POST',
    'options' => [
        'class' => 'form-horizontal',
    ],
]) ?>
<?= $form->field($model, 'name')->label('Họ Tên') ?>
<?= $form->field($model, 'phone')->label('Số Điện Thoại') ?>
<?= $form->field($model, 'facebook') ?>
<?= $form->field($model, 'address')->label('Địa Chỉ') ?>
<?= $form->field($model, 'ward')->label('Phường/Xã') ?>
<?= $form->field($model, 'district')->label('Quận/Huyện') ?>
<?= $form->field($model, 'city')->label('Thành Phố') ?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton('Tạo mới', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
