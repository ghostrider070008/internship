<?php


namespace app\controllers\actions;


use app\components\ProductComponent;
use app\models\Products;
use yii\base\Action;

class AddToBasketAction extends Action
{
    public  function run()
    {
        $id = \Yii::$app->request->post('Products')['id'];
        $count = \Yii::$app->request->post('Products')['count'];

        $productsModel = \Yii::createObject(['class' => ProductComponent::class, 'classModelProducts' => Products::class]);
        $product = $productsModel->getProduct($id);


        \Yii::$app->baskets->addToBasket($product, $count);


        return $this->controller->render('index', ['product' => $product]);
    }
}