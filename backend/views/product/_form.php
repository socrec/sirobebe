<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
use unclead\multipleinput\MultipleInput;

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

    <?=
    $form->field($model, 'date')->widget(DatePicker::className(), [
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'value' => $model->date ? $model->date : date('Y-m-d'),
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd'
        ]
    ])
    ?>

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
    //TODO: replace with better file uploader to handle update properly
//    echo $form->field($model, 'images[]')->widget(FileInput::classname(), [
//        'options' => [
//            'accept' => 'image/*',
//            'multiple' => true,
//            'showUpload' => true,
//        ],
//    ]);

    $columns = [
        [
            'name' => 'size',
            'type' => MaskedInput::className(),
            'options' => [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Size'
                ]
            ]
        ],
        [
            'name' => 'min_weight',
            'type' => MaskedInput::className(),
            'options' => [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Số kg nhỏ nhất'
                ]
            ]
        ],
        [
            'name' => 'max_weight',
            'type' => MaskedInput::className(),
            'options' => [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Số kg lớn nhất'
                ]
            ]
        ],
        [
            'name' => 'quantity',
            'type' => MaskedInput::className(),
            'options' => [
                'clientOptions' => [
                    'alias' => 'decimal',
                    'groupSeparator' => ',',
                    'autoGroup' => true
                ],
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Số lượng'
                ]
            ]
        ],
    ];
    if ($model->id) {
        $columns[] = [
            'name' => 'size_id',
            'type' => 'hiddenInput',
            'value' => function($data) {
                return $data['id'];
            },
        ];
    }
    echo $form->field($model, 'sizes')->widget(MultipleInput::className(), [
        'columns' => $columns
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tạo Mới' : 'Cập Nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>