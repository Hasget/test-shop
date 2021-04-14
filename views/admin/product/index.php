<?php

/* @var $this yii\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
/* @var $products \app\models\Products */
/* @var $product \app\models\Products */

use app\models\enums\CurrencyEnum;
use app\models\enums\StatusEnum;
use yii\widgets\LinkPager;

$this->title = 'Товары';
?>
    <ul class="nav nav-tabs">
        <li class="active"><a href="/admin/products">Товары</a></li>
        <li><a href="/admin/promo">Промокоды</a></li>
    </ul>

    <div class="container actions">
        <div class="row">
            <a href="/admin/product/add" class="btn btn-success">Добавить товар</a>
        </div>
    </div>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Наименование</th>
            <th scope="col">Цена</th>
            <th scope="col">Валюта</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <th scope="row"><?= $product->id ?></th>
                <td><a href="/admin/product/view/<?= $product->id ?>"><?= $product->name ?></a></td>
                <td><?= $product->price ?></td>
                <td><?= CurrencyEnum::$list[$product->currency] ?></td>
                <td><?= StatusEnum::$list[$product->status] ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

<?= LinkPager::widget([
    'pagination' => $provider->getPagination(),
]); ?>