<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="rơw">
        <div class="col-md-6">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php foreach ($model->productImages as $index => $image) { ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?= $index ?>" class="<?= $index == 0 ? 'active' : '' ?>"></li>
                    <?php } ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php foreach ($model->productImages as $index => $image) { ?>
                        <div class="item <?= $index == 0 ? 'active' : '' ?>">
                            <img style="width: 100%;" src="<?= $image->path ?>">
                        </div>
                    <?php } ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'title',
                    'list_price',
                    'gender',
                    'styles',
                ],
            ]) ?>
            <br>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Size</th>
                    <th>Cân Nặng Tối Thiểu</th>
                    <th>Cân Nặng Tối Đa</th>
                    <th>Số Lượng</th>
                </tr>
                <?php foreach ($model->productSizes as $size) { ?>
                    <tr>
                        <td><?= $size->size ?></td>
                        <td><?= $size->min_weight ?></td>
                        <td><?= $size->max_weight ?></td>
                        <td><?= $size->quantity ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.slick').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear'
        });
    });
</script>