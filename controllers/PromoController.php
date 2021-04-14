<?php

namespace app\controllers;

use app\models\enums\StatusEnum;
use app\models\Products;
use app\models\PromoCodes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class PromoController extends Controller
{
    public function actionActivate()
    {
        if ($code = Yii::$app->request->post('code')){
            $promoCode = PromoCodes::findOne(['label' => $code]);

            if (!$promoCode) {
                Yii::$app->session->setFlash('error', 'Промокод не найден.');
                return $this->redirect('/');
            }

            $session = Yii::$app->session;
            $session->set('promoCode', $promoCode->label);
            Yii::$app->session->setFlash('success', 'Промокод активирован.');
            return $this->redirect('/');
        }
    }

    public function actionRemove()
    {
        $session = Yii::$app->session;
        $session->remove('promoCode');
        Yii::$app->session->setFlash('success', 'Промокод удален.');
        return $this->redirect('/');

    }
}
