<?php


namespace app\controllers\actions;


use app\base\BaseAction;
use yii\web\Controller;

class SigninAction extends BaseAction
{
    public function run()
    {
        /** @var AuthComponent $comp */
        $comp = \Yii::$app->auth;

        $model = $comp->getModel(\Yii::$app->request->post());

        if (\Yii::$app->request->isPost) {

            if ($comp->signIn($model)) {

                Controller::goBack();

            }
        }

        return $this->controller->render('signin', ['model' => $model]);
    }
}