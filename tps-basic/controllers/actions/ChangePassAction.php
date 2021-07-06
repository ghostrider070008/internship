<?php

namespace app\controllers\actions;

use app\base\BaseAction;
use app\components\AuthComponent;
use app\models\Users;

class ChangePassAction extends BaseAction
{
    public function run()
    {

        $usersModel = \Yii::createObject(['class' => AuthComponent::class, 'classModelUsers' => Users::class]);

        $model = $usersModel->getClassModelUsers();
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->auth->changePass($model)) {
                \Yii::$app->response->redirect('/');
            }
        }
        return $this->controller->render('changepass', ['model' => $model]);
    }
}