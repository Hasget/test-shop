<?php

/* @var $this yii\web\View */
/* @var $product \app\models\Products */

use app\models\enums\CurrencyEnum;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($product, 'slug')->textInput(['maxlength' => true]) ?>

<?= $form->field($product, 'price')->textInput(['maxlength' => true]) ?>

<?= $form->field($product, 'currency')->dropDownList(CurrencyEnum::$list) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>