<?php

/* @var $this yii\web\View */
/* @var $promoCode \app\models\PromoCodes */
/* @var $products array */
/* @var $selectedProducts array */

use app\models\enums\PromoTypeEnum;
use dosamigos\multiselect\MultiSelect;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($promoCode, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($promoCode, 'label')->textInput(['maxlength' => true]) ?>

<?= $form->field($promoCode, 'type')->dropDownList(PromoTypeEnum::$list) ?>

<?= $form->field($promoCode, 'discount')->textInput() ?>


<div class="form-group">
    <label class="control-label" for="promocodes-discount">Доступна для</label><br>
    <?=
        MultiSelect::widget([
            "options" => ['multiple'=>"multiple"], // for the actual multiselect
            'data' => $products, // data as array
            'value' => $selectedProducts, // if preselected
            'name' => 'products', // name for the form
            "clientOptions" =>
                [
                    "includeSelectAllOption" => true,
                    'numberDisplayed' => 20
                ],
        ]);
    ?>
</div>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>