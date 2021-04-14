<?php

namespace app\models;

/**
 * This is the model class for table "promo_links".
 *
 * @property int $id
 * @property int|null $promo_id
 * @property int|null $product_id
 *
 * @property Products $product
 * @property PromoCodes $promo
 */
class PromoLinks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['promo_id', 'product_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['promo_id'], 'exist', 'skipOnError' => true, 'targetClass' => PromoCodes::className(), 'targetAttribute' => ['promo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promo_id' => 'Promo ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Promo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPromo()
    {
        return $this->hasOne(PromoCodes::className(), ['id' => 'promo_id']);
    }
}
