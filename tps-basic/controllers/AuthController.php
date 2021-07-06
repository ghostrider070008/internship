<?php


namespace app\controllers;


use app\controllers\actions\ActivationAction;
use app\controllers\actions\ChangePassAction;
use app\controllers\actions\SigninAction;
use app\controllers\actions\SignupAction;
use yii\base\Controller;

class AuthController extends Controller
{
    public function actions()
    {
        return [
            'signup' => ['class'=>SignupAction::class],
            'signin' =>['class'=>SigninAction::class],
            'activation'=>['class'=>ActivationAction::class],
            'changepass'=>['class'=>ChangePassAction::class],
        ];
    }
}