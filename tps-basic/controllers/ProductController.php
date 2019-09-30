<?php

namespace app\controllers;


use yii\base\Controller;
use app\components\ProductComponent;
use app\models\Products;

class ProductController extends Controller
{
    public function actionIndex()
    {

        $id = \Yii::$app->request->get('id');

        $product = \Yii::$app->product->getProduct($id);



        return $this->render('index', ['product' => $product]);
    }
}