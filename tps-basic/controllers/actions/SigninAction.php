<?php


namespace app\controllers\actions;


use app\base\BaseAction;
use app\models\Users;

class SigninAction extends BaseAction
{
    public function run()
    {
        $model=new Users();
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            if(\Yii::$app->auth->signIn($model)){
                \Yii::$app->response->redirect('/');
            }

        }
        return $this->controller->render('signin',['model'=>$model]);
    }
}