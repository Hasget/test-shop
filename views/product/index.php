<?php

/* @var $this yii\web\View */

use app\helpers\PriceHelper;
use app\widgets\PromoForm;
use yii\widgets\LinkPager;

/* @var $provider \yii\data\ActiveDataProvider */
/* @var $products \app\models\Products */
/* @var $product \app\models\Products */

$this->title = 'Товары';
?>
<div class="site-index">

    <div class="body-content">

        <?= PromoForm::widget() ?>

        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h3><?= $product->name ?></h3>
                            <?= PriceHelper::getPriceHtml($product) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?= LinkPager::widget([
            'pagination' => $provider->getPagination(),
        ]); ?>

    </div>
</div>
