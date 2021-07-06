<?php

namespace app\controllers\actions;

use app\base\BaseAction;
use app\components\AuthComponent;
use app\components\BasketsComponent;
use app\models\Users;

class SigninAction extends BaseAction
{
    public function run()
    {

        $usersModel = \Yii::createObject(['class' => AuthComponent::class, 'classModelUsers' => Users::class]);

        $model = $usersModel->getClassModelUsers();
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->auth->signIn($model)) {

                //слияние корзин
                \Yii::$app->baskets->mergeBaskets();
                //

                \Yii::$app->response->redirect('/');
            }
        }
        return $this->controller->render('signin', ['model' => $model]);
    }
}