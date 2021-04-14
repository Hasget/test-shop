<?php

/* @var $this yii\web\View */
/* @var $product \app\models\Products */

use app\models\enums\CurrencyEnum;
use app\models\enums\StatusEnum;
use yii\helpers\Html;

$this->title = 'Товар № ' . $product->id;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['/admin/products']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container actions">
    <div class="row">
        <a href="/admin/product/edit/<?= $product->id ?>" class="btn btn-primary">Редактировать</a>
        <?php if ($product->isDraft()): ?>
            <form class="action-form" method="POST" action="/admin/product/activate/<?= $product->id ?>">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <button class="btn btn-success">Активировать</button>
            </form>
        <?php endif; ?>

        <?php if ($product->isActive()): ?>
            <form class="action-form" method="POST" action="/admin/product/draft/<?= $product->id ?>">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <button class="btn btn-warning">В черновик</button>
            </form>
        <?php endif; ?>
        <form class="action-form" method="POST" action="/admin/product/delete/<?= $product->id ?>">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>

<table class="table table-striped table-bordered detail-view">
    <tbody>
    <tr>
        <th>ID</th>
        <td><?= $product->id ?></td>
    </tr>
    <tr>
        <th>Наименование</th>
        <td><?= $product->name ?></td>
    </tr>

    <tr>
        <th>Slug</th>
        <td><?= $product->slug ?></td>
    </tr>

    <tr>
        <th>Цена</th>
        <td><?= $product->price ?></td>
    </tr>

    <tr>
        <th>Валюта</th>
        <td><?= CurrencyEnum::$list[$product->currency] ?></td>
    </tr>

    <tr>
        <th>Статус</th>
        <td><?= StatusEnum::$list[$product->status] ?></td>
    </tr>
    </tbody>
</table>
