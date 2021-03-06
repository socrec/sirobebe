<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Sửa sản phẩm: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Kho Hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">
    <div class="panel panel-info">
        <div class="panel-heading"><h4><?= Html::encode($this->title) ?></h4></div>
        <div class="panel-body">
            <div class="col-md-12">
                <?= $this->render('_form', [
                    'model' => $model,
                    'styles' => $styles
                ]) ?>
            </div>
        </div>
    </div>
</div>
