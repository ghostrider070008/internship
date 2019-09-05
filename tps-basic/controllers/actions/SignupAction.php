<?php


namespace app\controllers\actions;


use app\base\BaseAction;
use app\models\Users;

class SignupAction extends BaseAction
{

    public function run()
    {
        $model=new Users();
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            \Yii::$app->auth->signUp($model);
        }
        return $this->controller->render('signup',['model'=>$model]);
    }
}