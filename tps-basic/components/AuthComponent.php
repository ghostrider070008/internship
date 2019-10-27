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

    public function signUp(Users &$model)
    {
        $model->scenarioSignup();
        if (!$model->validate(['email', 'password', 'phoneNumber'])) {
            return false;
        }
        $model->password_hash = $this->genPasswordHash($model->password);
        $model->token = $this->genToken();
        $this->sendActivationUserMail($model->email, $model->token);
        if (!$model->save()) {
            return false;
        }

        \Yii::$app->rbac->addRole($model->id);

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

    //Смена пароля
    public function changePass(Users &$model)
    {
        if (!$model->validate(['newPassword'])) {
            return false;
        }

        $user = Users::find()->andWhere(['id' => \Yii::$app->session['__id']])->one();

        if (!$this->validatePassword($model->password, $user->password_hash)) {
            $model->addError('password', 'Неверный пароль');
            return false;
        }

        $user->password_hash = $this->genPasswordHash($model->newPassword);

        if (!$user->save($model->password = false, $model->updateAt = null)) {
            return false;
        }
        return true;
    }




}