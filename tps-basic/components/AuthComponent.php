<?php
namespace app\components;
use app\base\BaseComponent;
use app\models\Users;
class AuthComponent extends BaseComponent
{
    public function signUp(Users &$user)
    {
        $user->scenarioSignup();
        if (!$user->validate(['email', 'password', 'phoneNumber'])) {
            return false;
        }
        $user->password_hash = $this->genPasswordHash($user->password);
        $user->token = $this->genToken();
        if (!$user->save()) {
            return false;
        }
        return true;
    }
    public function signIn(Users &$model)
    {
        $model->scenarioSignIn();
        if (!$model->validate(['email', 'password'])) {
            return false;
        }
        $user = $this->getUserByEmail($model->email);
        if(!$this->validatePassword($model->password, $user->password_hash)){
            $model->addError('password', 'Неверный пароль или учетная запись не активирована');
            return false;
        }
        return \Yii::$app->user->login($user, 3600);
    }
    private function genPasswordHash($password)
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }
    private function genToken()
    {
        return \Yii::$app->security->generateRandomString(25);
    }
    private function getUserByEmail($email)
    {
        return Users::find()->andWhere(['email' => $email])->one();
    }
    private function validatePassword($password, $passwordHash)
    {
        return \Yii::$app->security->validatePassword($password, $passwordHash);
    }
}