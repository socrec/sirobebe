<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Van Anh Shop';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Xin chào! Hôm nay là ngày <?= date('d/m/Y') ?></h2>
        <br>
        <p>
            <a class="btn btn-lg btn-success" href="<?= Url::to(['customer/index']) ?>">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Khách Hàng
            </a>
            <a class="btn btn-lg btn-warning" href="<?= Url::to(['order/index']) ?>">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Đơn Hàng
            </a>
        </p>
    </div>
</div>
