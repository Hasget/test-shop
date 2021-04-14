<?php

namespace app\controllers\admin;

use app\models\Products;
use app\models\PromoCodes;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PromoController extends Controller
{
    public function actionIndex()
    {
        $query = PromoCodes::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'provider' => $dataProvider,
            'promoCodes' => $dataProvider->getModels()
        ]);
    }

    public function actionAdd() {
        $promoCode = new PromoCodes();
        $products = Products::find()->select(['id', 'name'])->asArray()->all();

        if ($promoCode->load(Yii::$app->request->post())) {
            $promoCode->products = Yii::$app->request->post('products');
            if ($promoCode->save()){
                Yii::$app->session->setFlash('success', 'Промокод сохранен.');
                return $this->redirect('index');
            } else {
                return $this->render('add', [
                    'promoCode' => $promoCode
                ]);
            }
        }

        return $this->render('add', [
            'promoCode' => $promoCode,
            'products' => ArrayHelper::map($products, 'id', 'name'),
            'selectedProducts' => []
        ]);
    }

    public function actionView($id){
        $promoCode = PromoCodes::findOne($id);

        if (!$promoCode){
            throw new NotFoundHttpException('Промокод не найдена.');
        }

        return $this->render('view', [
            'promoCode' => $promoCode,
        ]);
    }

    public function actionEdit($id)
    {
        $promoCode = PromoCodes::findOne($id);
        $products = Products::find()->select(['id', 'name'])->asArray()->all();

        if (!$promoCode) {
            throw new NotFoundHttpException('Страница не найдена.');
        }

        if ($promoCode->load(Yii::$app->request->post())) {
            $promoCode->products = Yii::$app->request->post('products');
            if ($promoCode->save()) {
                Yii::$app->session->setFlash('success', 'Промокод сохранен.');
                return $this->redirect(['view', 'id' => $promoCode->id]);
            }
        }

        return $this->render('edit', [
            'promoCode' => $promoCode,
            'products' => ArrayHelper::map($products, 'id', 'name'),
            'selectedProducts' => $promoCode->getProducts()->column()
        ]);
    }

    public function actionDelete($id){
        $promoCode = PromoCodes::findOne($id);

        if (Yii::$app->request->isPost && $promoCode){


            if ($promoCode->delete()){
                Yii::$app->session->setFlash('success', 'Промокод удален.');
            }

            return $this->redirect(['/admin/promo']);
        } else {
            throw new BadRequestHttpException('Не корректное тело запроса.');
        }
    }
}
