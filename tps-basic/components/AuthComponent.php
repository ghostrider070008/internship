<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Users;

class AuthComponent extends BaseComponent
{

    /**@var string class of users entity*/

    public $auth_class;

    /**
     * @param null $params
     * @return Users
     */
    public function getModel($params=null) {

        /** @var Users $model */

        $model = \Yii::$container->get($this->auth_class);

        if ($params) {
            $model->load($params);
        }

        return $model;
        
    }


    public function signUp(Users &$user)
    {
        $user->scenarioSignup();

        if (!$user->validate('email', 'password')) {
            return false;
        }
            $user->password_hash = $this->genPasswordHash($user->password);
            $user->token=$this->genToken();
            if(!$user->save()){
                return false;
            }

        return true;
    }

    private function genPasswordHash($password)
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }

    private function genToken(){
        return \Yii::$app->security->generateRandomString(25);
    }

    public  function signIn(Users &$model)
    {
        $model->scenarioSignIn();

        $user = $this->getUserByEmail($model->email);

        if (!$user) {
            $model->addError('email', 'Пользователь с email '.$model->email.' не зарегистрирован');
            return false;
        }

        if (!$this->validatePassword($model->password, $user->password_hash)) {
            $model->addError('password', 'Неверный пароль!');
            return false;
        }

        $user->username = $user->email;

        return \Yii::$app->user->login($user);
    }

    public function getUserByEmail($email) {
        return $this -> getModel()::find()->andWhere(['email' => $email])->one();
    }

    public function validatePassword($password, $hash) {
        return \Yii::$app->security->validatePassword($password, $hash);
    }
}