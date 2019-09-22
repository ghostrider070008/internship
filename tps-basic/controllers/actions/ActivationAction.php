<?php


namespace app\controllers\actions;

use yii\base\Action;

class ActivationAction extends Action
{

    public function run(){
        $codeActivation = \Yii::$app->request->get('code');
        \Yii::$app->auth->confirmEmailToken($codeActivation);
        header('Refresh: 3; /auth/signin');
        return $this->controller->render('confirm');

    }
}