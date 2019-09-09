<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $token
 * @property string $firstname
 * @property string $lastname
 * @property string $surname
 * @property int $phoneNumber
 * @property string $createAt
 * @property string $updateAt
 * @property int $status
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'token', 'phoneNumber'], 'required'],
            [['phoneNumber', 'status'], 'integer'],
            [['createAt', 'updateAt'], 'safe'],
            [['username', 'firstname', 'lastname', 'surname'], 'string', 'max' => 45],
            [['email', 'token'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 300],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'surname' => Yii::t('app', 'Surname'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'createAt' => Yii::t('app', 'Create At'),
            'updateAt' => Yii::t('app', 'Update At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
