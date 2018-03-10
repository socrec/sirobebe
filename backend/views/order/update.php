<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

$this->title = 'Sửa đơn: ' . str_pad($model->id, 5, '0', STR_PAD_LEFT);
$this->params['breadcrumbs'][] = ['label' => 'Đơn Hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => str_pad($model->id, 5, '0', STR_PAD_LEFT), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'customerModel' => $customerModel
]) ?>