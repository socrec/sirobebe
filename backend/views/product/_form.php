<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['required' => true]) ?>
    <?= $form->field($model, 'import_price')->textInput([
        'options' => [
        'required' => true,
        'style' => 'width: 200px !important',
        'class' => 'form-control'
        ]
    ]) ?>
    <?= $form->field($model, 'list_price')->textInput([
        'options' => [
            'required' => true,
            'style' => 'width: 200px !important',
            'class' => 'form-control'
        ]
    ])?>

    <?php
    echo '<label class="control-label">Ngày Nhập Hàng</label>';
    echo DatePicker::widget([
        'name' => 'date',
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'value' => $model->date ? $model->date : date('d/m/Y'),
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd/mm/yyyy'
        ]
    ]);
    ?>
    <br>

    <?= $form->field($model, 'from')->textInput(['required' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'New' => 'New',
        'Sale Off' => 'Sale Off'
    ], ['required' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList([
        'Boy' => 'Boy',
        'Girl' => 'Girl',
        'Unisex' => 'Unisex',
    ], ['required' => true]) ?>

    <?php
    echo $form->field($model, 'styles')->widget(Select2::classname(), [
        'data' => $styles,
        'options' => ['placeholder' => 'Chọn 1 kiểu dáng ...', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]);

    echo $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])
        ->label($model->id ? 'Thêm Ảnh Sản Phẩm' : 'Ảnh Sản Phẩm');
//    echo $form->field($model, 'images[]')->widget(FileInput::classname(), [
//        'options' => [
//            'accept' => 'image/*',
//            'multiple' => true,
//            'showUpload' => true,
//        ],
//    ]);
    ?>
    <div class="row-plus">
        <label class="control-label" for="product-import_price">Sizes</label>
        <?php if($model->id) {
            foreach ($model->productSizes as $index => $size) { ?>
                <div class="row">
                    <input type="hidden" name="Product[size_id][]" value="<?= $size->id ?>">
                    <div class="form-group field-product-import_price col-md-2">
                        <?=
                        MaskedInput::widget([
                            'name' => 'Product[size][]',
                            'value' => $size->size,
                            'clientOptions' => [
                                'alias' => 'decimal',
                                'groupSeparator' => ',',
                                'autoGroup' => true
                            ],
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Size'
                            ]
                        ]);
                        ?>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-product-import_price col-md-2">
                        <!--            <input id="product-import_price" class="form-control" name="Product[min_weight][]" required="" type="text">-->
                        <?=
                        MaskedInput::widget([
                            'name' => 'Product[min_weight][]',
                            'value' => $size->min_weight,
                            'clientOptions' => [
                                'alias' => 'decimal',
                                'groupSeparator' => ',',
                                'autoGroup' => true
                            ],
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Số Kg Nhỏ Nhất'
                            ]
                        ]);
                        ?>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-product-import_price col-md-2">
                        <?= MaskedInput::widget([
                            'name' => 'Product[max_weight][]',
                            'value' => $size->max_weight,
                            'clientOptions' => [
                                'alias' => 'decimal',
                                'groupSeparator' => ',',
                                'autoGroup' => true
                            ],
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Số Kg Lớn Nhất'
                            ]
                        ]); ?>
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-product-import_price col-md-2">
                        <?= MaskedInput::widget([
                            'name' => 'Product[quantity][]',
                            'value' => $size->quantity,
                            'clientOptions' => [
                                'alias' => 'decimal',
                                'groupSeparator' => ',',
                                'autoGroup' => true
                            ],
                            'options' => [
                                'class' => 'form-control',
                                'placeholder' => 'Số Lượng Hàng'
                            ]
                        ]); ?>
                        <div class="help-block"></div>
                    </div>
                    <div class="col-md-2">
                        <?php if ($index == 0) { ?>
                            <a onclick="addRow(this)" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="row">
                <div class="form-group field-product-import_price col-md-2">
                    <?=
                    MaskedInput::widget([
                        'name' => 'Product[size][]',
                        'clientOptions' => [
                            'alias' => 'decimal',
                            'groupSeparator' => ',',
                            'autoGroup' => true
                        ],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Size'
                        ]
                    ]);
                    ?>
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-product-import_price col-md-2">
        <!--            <input id="product-import_price" class="form-control" name="Product[min_weight][]" required="" type="text">-->
                    <?=
                    MaskedInput::widget([
                        'name' => 'Product[min_weight][]',
                        'clientOptions' => [
                            'alias' => 'decimal',
                            'groupSeparator' => ',',
                            'autoGroup' => true
                        ],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Số Kg Nhỏ Nhất'
                        ]
                    ]);
                    ?>
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-product-import_price col-md-2">
                    <?= MaskedInput::widget([
                        'name' => 'Product[max_weight][]',
                        'clientOptions' => [
                            'alias' => 'decimal',
                            'groupSeparator' => ',',
                            'autoGroup' => true
                        ],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Số Kg Lớn Nhất'
                        ]
                    ]); ?>
                    <div class="help-block"></div>
                </div>
                <div class="form-group field-product-import_price col-md-2">
                    <?= MaskedInput::widget([
                        'name' => 'Product[quantity][]',
                        'clientOptions' => [
                            'alias' => 'decimal',
                            'groupSeparator' => ',',
                            'autoGroup' => true
                        ],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Số Lượng Hàng'
                        ]
                    ]); ?>
                    <div class="help-block"></div>
                </div>
                <div class="col-md-2">
                    <a onclick="addRow(this)" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo Mới' : 'Cập Nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $(function () {
    });
    function removeRow(a) {
        var div = $($(a).parents('.row')[0]);
        div.remove();
    }
    function addRow(a) {
        var div = $($(a).parents('.row-plus')[0]);
        var html = '<div class="row">'+
            '<div class="form-group field-product-import_price col-md-2">'+
            '<input type="hidden" name="Product[size_id][]" value="-1">'+
            '<?=
            MaskedInput::widget([
                'name' => 'Product[size][]',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Size'
                ]
            ]);
            ?>'+
            '<div class="help-block"></div>'+
            '</div>'+
            '<div class="form-group field-product-import_price col-md-2">'+
            '<?=
            MaskedInput::widget([
                'name' => 'Product[min_weight][]',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Số Kg Nhỏ Nhất'
                ]
            ]);
            ?>'+
            '<div class="help-block"></div>'+
            '</div>'+
            '<div class="form-group field-product-import_price col-md-2">'+
            '<?= MaskedInput::widget([
                'name' => 'Product[max_weight][]',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Số Kg Lớn Nhất'
                ]
            ]); ?>'+
            '<div class="help-block"></div>'+
            '</div>'+
            '<div class="form-group field-product-import_price col-md-2">'+
            '<?= MaskedInput::widget([
                'name' => 'Product[quantity][]',
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Số Lượng Hàng'
                ]
            ]); ?>'+
            '<div class="help-block"></div>'+
            '</div>'+
            '<div class="col-md-2">'+
            '<a onclick="removeRow(this)" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>'+
            '</div>'+
            '</div>';
        div.append(html);
    }
</script>