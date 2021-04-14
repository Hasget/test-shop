<?php

/* @var $this yii\web\View */
/* @var $promoCode \app\models\Products */
/* @var $products array */
/* @var $selectedProducts array */

$this->title = 'Добавление промокода';
$this->params['breadcrumbs'][] = ['label' => 'Промокоды', 'url' => ['/admin/promo']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_form', [
    'promoCode' => $promoCode,
    'products' => $products,
    'selectedProducts' => $selectedProducts
]) ?>