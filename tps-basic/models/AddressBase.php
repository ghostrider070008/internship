<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Address".
 *
 * @property int $id
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $street
 * @property string $building
 * @property string $apartment
 * @property int $user_id
 * @property string $createAt
 * @property string $updatedAt
 */
class AddressBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country', 'region', 'city', 'street', 'building', 'apartment', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['createAt', 'updatedAt'], 'safe'],
            [['country', 'region', 'city', 'street'], 'string', 'max' => 150],
            [['building', 'apartment'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'region' => 'Region',
            'city' => 'City',
            'street' => 'Street',
            'building' => 'Building',
            'apartment' => 'Apartment',
            'user_id' => 'User ID',
            'createAt' => 'Create At',
            'updatedAt' => 'Updated At',
        ];
    }
}