<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $product_name
 * @property int $category_id
 * @property string $img
 * @property string $description
 * @property string $price
 * @property string $date_created
 * @property string $date_updated
 */
class ProductsBase extends \yii\db\ActiveRecord
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
            [['product_name', 'category_id', 'img', 'description', 'price'], 'required'],
            [['category_id'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['date_created', 'date_updated'], 'safe'],
            [['product_name', 'img'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'category_id' => 'Category ID',
            'img' => 'Img',
            'description' => 'Description',
            'price' => 'Price',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }
}
