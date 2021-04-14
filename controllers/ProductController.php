<?php

namespace app\controllers;

use app\models\enums\StatusEnum;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $query = Products::find()->where(['status' => StatusEnum::ACTIVE]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'provider' => $dataProvider,
            'products' => $dataProvider->getModels()
        ]);
    }
}
