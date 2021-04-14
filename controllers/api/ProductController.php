<?php

namespace app\controllers\api;

use app\models\enums\StatusEnum;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\Response;

class ProductController extends Controller
{
    public function actionJson() {
        $query = Products::find()->where(['status' => StatusEnum::ACTIVE]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $dataProvider;
    }
}
