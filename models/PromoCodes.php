<?php

namespace app\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * This is the model class for table "promo_codes".
 *
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string|null $type
 * @property float $discount
 *
 * @property PromoLinks[] $promoLinks
 * @property Products[] $products
 */
class PromoCodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'label', 'discount'], 'required', 'message' => 'Данное поле обязательно для заполнения.'],
            [['label'], 'unique', 'message' => 'Данный промокод уже существует.'],
            [['type'], 'string'],
            [['discount'], 'number', 'message' => 'Неверный формат данных.'],
            [['name', 'label'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'label' => 'Код',
            'type' => 'Тип скидки',
            'discount' => 'Скидка'
        ];
    }

    public function behaviors()
    {
        return [
            'saveRelations' => [
                'class'     => SaveRelationsBehavior::className(),
                'relations' => [
                    'products'
                ],
            ],
        ];
    }

    /**
     * Gets query for [[PromoLinks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPromoLinks()
    {
        return $this->hasMany(PromoLinks::className(), ['promo_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['id' => 'product_id'])
            ->viaTable('promo_links', ['promo_id' => 'id']);
    }
}
