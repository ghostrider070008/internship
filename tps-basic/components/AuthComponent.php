<?php

namespace app\components;

use app\base\BaseComponent;
use app\models\Users;

class AuthComponent extends BaseComponent
{
    public $classModelUsers;

    public function getClassModelUsers()
    {
        return new $this->classModelUsers();
    }

    public function signUp(Users &$user)
    {
        $user->scenarioSignup();
        if (!$user->validate(['email', 'password', 'phoneNumber'])) {
            return false;
        }
        $user->password_hash = $this->genPasswordHash($user->password);
        $user->token = $this->genToken();
        $this->sendActivationUserMail($user->email, $user->token);
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
        if (!$this->validatePassword($model->password, $user->password_hash) or $user->status == 0) {
            $model->addError('password', 'Неверный пароль или учетная запись не активирована');
            return false;

        }
        return \Yii::$app->user->login($user, 3600);
    }

    private function genPasswordHash($password)
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }

    // Генерация уникального токена для подтверждения почты
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


   //Подтверждение регистрации пользователя
    public function confirmEmailToken($token): bool
    {
        $findUserForActivation = Users::find()->andWhere(['token' => $token])->one();
        if (!$findUserForActivation) {
            return false;
        } else {
            $findUserForActivation->status = 1;
            $findUserForActivation->save(false);
        }
        return true;

    }

    //Отправка письма с кодом подтверждения
    public static function sendActivationUserMail($email, $token)
    {
        \Yii::$app->mailer->compose('mail', compact('email', 'token'))
            ->setFrom('tpsconfirmemail@gmail.com')
            ->setTo($email)
            ->setSubject('Активация аккаунта')
            ->send();
    }
}