<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Users;

class AuthComponent extends BaseComponent
{
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
}