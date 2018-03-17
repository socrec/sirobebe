<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

$this->title = 'Tạo đơn';
$this->params['breadcrumbs'][] = ['label' => 'Đơn Hàng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'customerModel' => $customerModel,
    'selectedProducts' => [],
]) ?>
