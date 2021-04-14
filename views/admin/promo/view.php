<?php

/* @var $this yii\web\View */

/* @var $promoCode \app\models\PromoCodes */

use app\assets\AppAsset;
use app\models\enums\PromoTypeEnum;
use yii\helpers\Html;

$this->title = 'Промокод № ' . $promoCode->id;
$this->params['breadcrumbs'][] = ['label' => 'Промокоды', 'url' => ['/admin/promo']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container actions">
    <div class="row">
        <a href="/admin/promo/edit/<?= $promoCode->id ?>" class="btn btn-primary">Редактировать</a>
        <form class="action-form" method="POST" action="/admin/promo/delete/<?= $promoCode->id ?>">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>
</div>

<table class="table table-striped table-bordered detail-view">
    <tbody>
    <tr>
        <th>ID</th>
        <td><?= $promoCode->id ?></td>
    </tr>
    <tr>
        <th>Наименование</th>
        <td><?= $promoCode->name ?></td>
    </tr>

    <tr>
        <th>Код</th>
        <td><?= $promoCode->label ?></td>
    </tr>

    <tr>
        <th>Тип скидки</th>
        <td><?= PromoTypeEnum::$list[$promoCode->type] ?></td>
    </tr>

    <tr>
        <th>Скидка</th>
        <td><?= $promoCode->discount ?></td>
    </tr>
    </tbody>
</table>