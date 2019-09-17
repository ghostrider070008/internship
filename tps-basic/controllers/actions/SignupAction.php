<?php


namespace app\controllers\actions;


use app\base\BaseAction;
use app\models\Users;
use yii\web\Controller;

class SignupAction extends BaseAction
{

    public function run()
    {
        /** @var AuthComponent $comp */
        $comp = \Yii::$app->auth;

        $model = $comp->getModel(\Yii::$app->request->post());

        if(\Yii::$app->request->isPost){

            if ($comp->signUp($model)) {
                \Yii::$app->session->addFlash('success', 'Пользователь успешно зарегистрирован с id '.$model->id);
                return Controller::redirect(['/auth/signin']);
            }
        }
        return $this->controller->render('signup',['model'=>$model]);
    }
}