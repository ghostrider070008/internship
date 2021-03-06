<?php
namespace app\controllers\actions;
use app\base\BaseAction;
use app\components\AuthComponent;
use app\models\Users;

class SignupAction extends BaseAction
{
    public function run()
    {
        $usersModel = \Yii::createObject(['class' => AuthComponent::class, 'classModelUsers' => Users::class]);

        $model = $usersModel->getClassModelUsers();

        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if(\Yii::$app->auth->signUp($model)){
                \Yii::$app->response->redirect('/auth/signin');
            }
        }
        return $this->controller->render('signup',['model'=>$model]);
    }
}