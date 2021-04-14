<?php

use yii\helpers\Html;

/* @var $promoCode \app\models\PromoCodes */

?>

<div class="wrapper text-center" style="margin-bottom: 40px;">
    <?php if ($promoCode): ?>

        <h5>Вы активировали промокод <?= $promoCode->name ?></h5>
        <form class="action-form text-center" method="POST" action="/promo/remove" style="margin: 0 auto;">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <button class="btn btn-success" style="margin-top: 20px;">Удалить</button>
        </form>

    <?php else: ?>
        <h5>Активируйте ваш промокод</h5>
        <form class="action-form text-center" method="POST" action="/promo/activate" style="margin: 0 auto;">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <input name="code" class="form-control" value="" style="display: inline-block">
            <button class="btn btn-success" style="margin-top: 20px;">Активировать</button>
        </form>
    <?php endif; ?>
</div>
