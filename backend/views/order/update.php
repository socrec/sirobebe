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
    'action' => Url::to(['order/update', 'id' => $model->id]),
    'method' => 'POST',
    'options' => [
        'class' => 'form-horizontal',
    ],
]) ?>
<?= $form->field($model, 'customer_id')->dropdownList([
        $model->customer_id => $model->customer->name
    ],
    [
        'prompt'=>'Chọn khách hàng',
        'id' => 'customer-load'
    ])->label('Khách Hàng') ?>
<?= $form->field($model, 'total')->label('Tiền Hàng') ?>
<?= $form->field($model, 'shipping_fee')->label('Phí Ship') ?>
<?= $form->field($model, 'memo')->textarea()->label('Ghi Chú') ?>

<div class="form-group">
    <div class="col-lg-11">
        <?= Html::submitButton('Cập Nhật', ['class' => 'btn btn-primary']) ?>
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
