<?php

/* @var $this yii\web\View */
/* @var $product \app\models\Products */

$this->title = 'Редактирование товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['/admin/products']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'product' => $product,
]) ?>
