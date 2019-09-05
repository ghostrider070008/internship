<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\SigninAction;
use app\controllers\actions\SignupAction;

class AuthController extends BaseController
{
    public function actions()
    {
        return [
            'signup' => ['class'=>SignupAction::class],
            'signin' =>['class'=>SigninAction::class],
        ];
    }
}