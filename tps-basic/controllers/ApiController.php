<?php


namespace app\controllers;


use app\models\Users;
use yii\rest\ActiveController;
use yii\web\Response;


class ApiController extends ActiveController
{
    public $modelClass = Users::class;
    public function behaviors()
    {
        $behaviors=parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}