<?php
namespace app\widgets;

use app\models\PromoCodes;
use Yii;
use yii\base\Widget;


class PromoForm extends Widget
{
    /**
     * @return string
     */
    public function run()
    {
        $session = Yii::$app->session;
        $promoCode = $session->get('promoCode');
        $promoCode = PromoCodes::findOne(['label' => $promoCode]);

        return $this->render('promo-form', [
            'promoCode' => $promoCode
        ]);
    }
}
