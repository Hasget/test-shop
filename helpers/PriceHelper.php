<?php

namespace app\helpers;

use app\models\enums\CurrencyEnum;
use app\models\enums\PromoTypeEnum;
use app\models\PromoCodes;
use Yii;

/* @var $promoCode PromoCodes*/

class PriceHelper {
    const USD_EXCHANGE_RATE = 75.59;
    const EURO_EXCHANGE_RATE = 90.50;

    /**
     * @param $product \app\models\Products
     * @return string
     */
    public static function getPriceHtml($product){
        $html = '';
        $price = $product->price;
        $promoPrice = null;
        $session = Yii::$app->session;
        $code = $session->get('promoCode');

        /** @var PromoCodes $promoCode */
        $promoCode = $product->getPromoCodes()->where(['label' => $code])->one();


        if ($product->currency === CurrencyEnum::EURO){
            $price = $product->price * self::EURO_EXCHANGE_RATE;
        }

        if ($product->currency === CurrencyEnum::USD){
            $price = $product->price * self::USD_EXCHANGE_RATE;
        }

        if ($promoCode){
            if ($promoCode->type === PromoTypeEnum::PERCENT){
                $promoPrice = $price - $price * $promoCode->discount / 100;
                $promoPrice= round($promoPrice, 2);
            }

            if ($promoCode->type === PromoTypeEnum::MONEY){
                $promoPrice = $price - $promoCode->discount;
                $promoPrice= round($promoPrice, 2);
                if ($promoPrice < 0) {
                    $promoPrice = 0;
                }
            }
        }

        if (!is_null($promoPrice)){
            $html .= '<span style="color: red;padding-right: 10px;"><b>'.$promoPrice.' Р</b></span>';
            $html .= '<span style="padding-right: 10px;"><s>'.$price.' Р</s></span>';
        } else {
            $html .= '<span style="padding-right: 10px;"><b>'.$price.' Р</b></span>';
        }

        if ($product->currency !== CurrencyEnum::RUB){
            $html .= '<span>('. $product->price .' USD)</span>';
        }

        return $html;
    }
}