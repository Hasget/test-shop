<?php

namespace app\controllers\admin;

use app\models\enums\StatusEnum;
use app\models\Products;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $query = Products::find();
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

    public function actionAdd() {
        $product = new Products();

        if ($product->load(Yii::$app->request->post())) {

            if ($product->save()){
                Yii::$app->session->setFlash('success', 'Товар сохранен.');
                return $this->redirect('index');
            } else {
                return $this->render('add', [
                    'product' => $product
                ]);
            }
        }

        return $this->render('add', [
            'product' => $product
        ]);
    }

    public function actionView($id){
        $product = Products::findOne($id);

        if (!$product){
            throw new NotFoundHttpException('Страница не найдена.');
        }

        return $this->render('view', [
            'product' => $product,
        ]);
    }

    public function actionEdit($id)
    {
        $product = Products::findOne($id);

        if (!$product) {
            throw new NotFoundHttpException('Страница не найдена.');
        }

        if ($product->load(Yii::$app->request->post())) {
            if ($product->save()) {
                Yii::$app->session->setFlash('success', 'Товар сохранен.');
                return $this->redirect(['view', 'id' => $product->id]);
            }
        }

        return $this->render('edit', [
            'product' => $product,
        ]);
    }

    public function actionActivate($id){
        $product = Products::findOne($id);

        if (Yii::$app->request->isPost && $product){
            if ($product->price) {
                $product->status = StatusEnum::ACTIVE;

                if ($product->save()){
                    Yii::$app->session->setFlash('success', 'Товар активирован.');
                }

                return $this->redirect(['view', 'id' => $product->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Не указана цена товара.');
                return $this->redirect(['view', 'id' => $product->id]);
            }
        } else {
            throw new BadRequestHttpException('Не корректное тело запроса.');
        }
    }

    public function actionDraft($id){
        $product = Products::findOne($id);

        if (Yii::$app->request->isPost && $product){
            $product->status = StatusEnum::DRAFT;

            if ($product->save()){
                Yii::$app->session->setFlash('success', 'Товар отправлен в черновик.');
            }

            return $this->redirect(['view', 'id' => $product->id]);
        } else {
            throw new BadRequestHttpException('Не корректное тело запроса.');
        }
    }

    public function actionDelete($id){
        $product = Products::findOne($id);

        if (Yii::$app->request->isPost && $product){
            if ($product->isActive()){
                Yii::$app->session->setFlash('error', 'Нельзя удалить активный товар');
                return $this->redirect(['view', 'id' => $product->id]);
            }

            if ($product->delete()){
                Yii::$app->session->setFlash('success', 'Товар удален.');
            }

            return $this->redirect(['/admin/products']);
        } else {
            throw new BadRequestHttpException('Не корректное тело запроса.');
        }
    }
}
