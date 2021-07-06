<?php
namespace app\models;
use Yii;
use yii\web\IdentityInterface;
class Users extends UsersBase implements IdentityInterface
{
    public $password;
    public $passwordRepeat;
    public $newPassword;
    public $newPasswordRepeat;

    const SCENARIO_SIGNUP = 'signup';
    const SCENARIO_SIGNIN = 'signin';
    public function scenarioSignup()
    {
        $this->setScenario(self::SCENARIO_SIGNUP);
        return $this;
    }
    public function scenarioSignIn()
    {
        $this->setScenario(self::SCENARIO_SIGNIN);
        return $this;
    }
    public function rules()
    {
        return array_merge([
            [['password', 'newPassword'], 'string', 'min' => 8],
            ['password', 'required'],
            /*['passwordRepeat', 'required'],*/
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
            ['email', 'email'],
            ['email', 'exist', 'on' => self::SCENARIO_SIGNIN],
            [['email'], 'unique', 'on' => self::SCENARIO_SIGNUP],
        ],
            parent::rules()
        );
    }
    public function attributeLabels()
    {
        return array_merge(
            [
                'password' => Yii::t('app', 'Password'),
                'passwordRepeat' => Yii::t('app', 'PasswordRepeat'),
                'newPassword' => Yii::t('app', 'New Password'),
                'newPasswordRepeat' => Yii::t('app', 'New Password Repeat'),
            ]
            , parent::attributeLabels());
    }
    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return Users::find()->andWhere(['id' => $id])->one();
    }
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }
    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }
    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}