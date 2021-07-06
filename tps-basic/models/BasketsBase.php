<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "baskets".
 *
 * @property int $id
 * @property int $product_id
 * @property int $count
 * @property string $total_price
 * @property int $user_id
 * @property string $createAt
 * @property string $updateAt
 */
class BasketsBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'baskets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'count', 'total_price', 'user_id'], 'required'],
            [['product_id', 'count', 'user_id'], 'integer'],
            [['total_price'], 'number'],
            [['createAt', 'updateAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'count' => 'Count',
            'total_price' => 'Total Price',
            'user_id' => 'User ID',
            'createAt' => 'Create At',
            'updateAt' => 'Update At',
        ];
    }
}
