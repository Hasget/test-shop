<?php

/* @var $this yii\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
/* @var $promoCodes \app\models\PromoCodes */
/* @var $promoCode \app\models\PromoCodes */

use app\models\enums\PromoTypeEnum;
use yii\widgets\LinkPager;

$this->title = 'Промокоды';
?>
<div class="site-index">

    <ul class="nav nav-tabs">
        <li><a href="/admin/products">Товары</a></li>
        <li class="active"><a href="/admin/promo">Промокоды</a></li>
    </ul>

    <div class="container actions">
        <div class="row">
            <a href="/admin/promo/add" class="btn btn-success">Добавить промокод</a>
        </div>
    </div>

    <?php if ($promoCodes): ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование</th>
                <th scope="col">Код</th>
                <th scope="col">Скидка</th>
                <th scope="col">Тип скидки</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($promoCodes as $promoCode): ?>
                    <tr>
                        <th scope="row"><?= $promoCode->id ?></th>
                        <td><a href="/admin/promo/view/<?= $promoCode->id ?>"><?= $promoCode->name ?></a></td>
                        <td><?= $promoCode->label ?></td>
                        <td><?= $promoCode->discount ?></td>
                        <td><?= PromoTypeEnum::$list[$promoCode->type] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="text-center" style="margin-top: 60px;">
            <h5>Промокоды отсутствуют.</h5>
        </div>

    <?php endif; ?>

    <?= LinkPager::widget([
        'pagination' => $provider->getPagination(),
    ]); ?>
</div>
