<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 22.10.2019
 * Time: 23:05
 */

namespace app\controllers\actions;


use yii\base\Action;
use app\components\ProductComponent;
use app\models\Products;

class RemoveFromBasketAction extends Action
{
    public  function run()
    {
        $id = \Yii::$app->request->post('Products')['id'];

        $productsModel = \Yii::createObject(['class' => ProductComponent::class, 'classModelProducts' => Products::class]);
        $product = $productsModel->getProduct($id);


        \Yii::$app->baskets->removeFromBasket($product);


        return $this->controller->render('index', ['product' => $product]);
    }
}