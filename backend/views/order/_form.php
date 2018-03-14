<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;
use yii\widgets\MaskedInput;
use common\constants\Order;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">
    <?php
    $form = ActiveForm::begin([
        'id' => 'customer-form',
        'method' => 'POST',
    ]) ?>
    <div class="panel panel-info">
        <div class="panel-heading"><h4>Chi tiết đơn</h4></div>
        <div class="panel-body">
            <div class="col-md-12">
                <?php
                $columns = [
                    [
                        'name' => 'size_id',
                        'title' => 'Tên',
                        'type' => Select2::className(),
                        'headerOptions' => [
                            'class' => 'col-md-9'
                        ],
                        'options' => [
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'data' => $selectedProducts,
                            'pluginOptions' => [
                                'minimumInputLength' => 1,
                                'ajax' => [
                                    'url' => Url::to(['product/get', 'by' => 'title']),
                                    'dataType' => 'json',
                                ],
                            ],
                            'pluginEvents' => [
                                'select2:select' => 'function(ev) {
                                    var data = ev.params.data,
                                        td = $(this).parents("td").first();
                                    
                                    td.find("input[id$=\'product_id\']").val(data.product_id);
                                    td.find("input[id$=\'list_price\']").val(data.list_price);
                                    td.find("input[id$=\'import_price\']").val(data.import_price);
                                    td.parent().find("input[id$=\'list_price_label\']").val(numberFormat(data.list_price));
                                    td.parent().find("input[id$=\'quantity\']").on("change", function() { calTotal(); });
                                    
                                    calTotal();
                                }',
                            ],
                        ]
                    ],
                    [
                        'name' => 'product_id',
                        'type' => 'hiddenInput'
                    ],
                    [
                        'name' => 'list_price',
                        'type' => 'hiddenInput'
                    ],
                    [
                        'name' => 'import_price',
                        'type' => 'hiddenInput'
                    ],
                    [
                        'name' => 'quantity',
                        'title' => 'Số lượng',
                        'headerOptions' => [
                            'class' => 'col-md-1'
                        ],
                        'type' => MaskedInput::className(),
                        'options' => [
                            'clientOptions' => [
                                'alias' => 'decimal',
                                'groupSeparator' => ',',
                                'autoGroup' => true
                            ],
                            'options' => [
                                'class' => 'form-control',
                            ]
                        ]
                    ],
                    [
                        'name' => 'list_price_label',
                        'title' => 'Đơn giá',
                        'value' => function ($model) {
                            return number_format($model['list_price']);
                        },
                        'headerOptions' => [
                            'class' => 'col-md-2'
                        ],
                        'options' => [
                            'readonly' => true,
                            'value' => 121292,
                            'style' => 'text-align: right'
                        ]
                    ],
                ];
                ?>
                <?= $form->field($model, 'products')->widget(MultipleInput::className(), [
                    'columns' => $columns
                ]);
                ?>
                <?= $form->field($model, 'shipping_fee')->widget(MaskedInput::className(), [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'groupSeparator' => ',',
                        'autoGroup' => true
                    ],
                    'options' => [
                        'class' => 'form-control',
                    ]
                ])->label('Phí Ship') ?>
                <div class="form-group field-order-shipping_fee required has-error">
                    <div class="col-md-10 text-right"><h3>Tổng:</h3></div>
                    <div class="col-md-2 text-right"><h3 id="total"><?= $model->id ? number_format($model->total) : 0 ?>đ</h3></div>
                </div>
                <?= $form->field($model, 'status')->dropDownList(Order::$statuses)->label('Trạng Thái') ?>
                <?= $form->field($model, 'tracking_number')->textInput()->label('Mã Vận Đơn') ?>
                <?= $form->field($model, 'memo')->textarea()->label('Ghi Chú') ?>
                <?= $form->field($model, 'total')->hiddenInput()->label(false)?>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active"><a href="#old-customer" role="tab" data-toggle="tab">KH đã tạo</a></li>
                <li role="presentation"><a href="#new-customer" role="tab" data-toggle="tab">KH mới</a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="old-customer">
                        <?= $form->field($model, 'customer_id')->dropdownList([
                            $model->customer_id => $model->customer->name
                        ],
                            [
                                'id' => 'customer-load'
                            ])->label('Khách Hàng') ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="new-customer">
                        <?= $form->field($customerModel, 'name')->label('Họ Tên') ?>
                        <?= $form->field($customerModel, 'phone')->label('Số Điện Thoại') ?>
                        <?= $form->field($customerModel, 'facebook') ?>
                        <?= $form->field($customerModel, 'address')->label('Địa Chỉ') ?>
                        <?= $form->field($customerModel, 'ward')->label('Phường/Xã') ?>
                        <?= $form->field($customerModel, 'district')->label('Quận/Huyện') ?>
                        <?= $form->field($customerModel, 'city')->label('Thành Phố') ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Cập nhật', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end() ?>
</div>
<script>
    function calTotal() {
        var total = 0;
        $('input[id$="list_price"]').each(function (key, item) {
            var quantity = 0,
                quantityInput = $(item).parents('tr').first().find('input[id$="quantity"]');
            if (quantityInput.val())
                quantity = parseFloat(quantityInput.val());

            if ($(item).val())
                total += parseFloat($(item).val()) * quantity;
        });

        if ($('#order-shipping_fee').val())
            total += parseFloat($('#order-shipping_fee').val().replace(/,/g, ''));

        $('#total').html(numberFormat(total) + 'đ');
        $('input#order-total').val(total);
    }
    $(function () {
        $('#customer-load').select2({
            ajax: {
                dataType: 'json',
                url: "<?= Url::to(['customer/load']) ?>",
                minimumInputLength: 1,
                placeholder: 'Chọn khách hàng',
                initSelection: function(element, callback) {
                },
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
        $('a[href="#new-customer"]').on('click', function (ev) {
            $('#customer-load').val(null).trigger('change');
        });
    })
    $('#order-shipping_fee').on('change', function (ev) {
        calTotal();
    })
    $('input[id$="quantity"]').on('change', function (ev) {
        calTotal();
    })
</script>