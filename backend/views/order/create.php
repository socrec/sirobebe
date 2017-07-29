<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

$this->title = 'Mari Na Shop - Đơn Hàng';
?>

<div class="container">
    <a class="pull-right btn btn-default" href="<?= Url::to(['order/index']) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
         Quay Lại</a>
</div>
<br>
<br>
<?php
$form = ActiveForm::begin([
    'id' => 'customer-form',
    'action' => Url::to(['order/create']),
    'method' => 'POST',
    'options' => [
        'class' => 'form-horizontal',
    ],
]) ?>
<h3>Đơn hàng</h3>
<?= $form->field($model, 'total')->label('Tiền Hàng') ?>
<?= $form->field($model, 'shipping_fee')->label('Phí Ship') ?>
<?= $form->field($model, 'memo')->textarea()->label('Ghi Chú') ?>
<hr>
<h3>
    Khách hàng đã tạo
</h3>
<?= $form->field($model, 'customer_id')->dropdownList([],
    [
        'prompt'=>'Chọn khách hàng',
        'id' => 'customer-load'
    ])->label('Khách Hàng') ?>
<hr>
<div class="new-customer">
    <h3>Khách hàng mới</h3>
    <?= $form->field($customerModel, 'name')->label('Họ Tên') ?>
    <?= $form->field($customerModel, 'phone')->label('Số Điện Thoại') ?>
    <?= $form->field($customerModel, 'facebook') ?>
    <?= $form->field($customerModel, 'address')->label('Địa Chỉ') ?>
    <?= $form->field($customerModel, 'ward')->label('Phường/Xã') ?>
    <?= $form->field($customerModel, 'district')->label('Quận/Huyện') ?>
    <?= $form->field($customerModel, 'city')->label('Thành Phố') ?>
</div>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton('Tạo mới', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<script>
    $(function () {
        $('#customer-load').select2({
            ajax: {
                dataType: 'json',
                url: "<?= Url::to(['customer/load']) ?>",
                minimumInputLength: 1,
                data: function (params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                },
            }
        });
    })
</script>
