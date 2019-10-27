<?php


namespace app\controllers\actions;


use app\base\BaseAction;
use app\components\ProductComponent;
use app\models\Products;

class ProductPageAction extends BaseAction
{
    public  function run()
    {
        $id = \Yii::$app->request->get('id');

        $product = \Yii::$app->product->getProduct($id);

        return $this->controller->render('index', ['product' => $product]);
    }
}