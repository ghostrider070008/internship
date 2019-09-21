<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 08.09.2019
 * Time: 17:44
 */

namespace app\controllers;


use app\base\BaseController;

class RbacController extends BaseController
{
    public function actionGen() {
        \Yii::$app->rbac->generateRbacRules();
    }
}