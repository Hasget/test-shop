<?php

namespace app\models;

use app\models\enums\StatusEnum;
use yii\helpers\Inflector;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property float|null $price
 * @property string|null $currency
 * @property string|null $status
 *
 * @property PromoCodes[] $promoCodes
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Данное поле обязательно для заполнения.'],
            [['price'], 'number', 'message' => 'Неверный формат данных.'],
            ['price', 'required', 'when' => function($model) {
                return $model->status === StatusEnum::ACTIVE;
            }, 'enableClientValidation' => false, 'message' => 'В активном товаре необходимо указать цену.'],
            [['currency', 'status'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['slug'], 'string', 'max' => 220],
            [['slug'], 'unique', 'message' => 'Данный alias уже существует.'],
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
            'slug' => 'Slug',
            'price' => 'Цена',
            'currency' => 'Валюта',
            'status' => 'Статус',
        ];
    }

    public function beforeSave($insert)
    {
        if (!$this->slug){
            $this->slug = Inflector::slug($this->name);
        }

        return parent::beforeSave($insert);
    }

    public function getPromoCodes() {
        return $this->hasMany(PromoCodes::className(), ['id' => 'promo_id'])
            ->viaTable('promo_links', ['product_id' => 'id']);
    }

    public function isDraft() {
        if ($this->status === StatusEnum::DRAFT){
            return true;
        }
        return  false;
    }

    public function isActive() {
        if ($this->status === StatusEnum::ACTIVE){
            return true;
        }
        return  false;
    }
}
