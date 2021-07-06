<?php


namespace app\controllers\actions;


use yii\base\Action;
use app\components\ProductComponent;
use app\models\Products;

class ChangeCountAction extends Action
{
    public  function run()
    {
        $id = \Yii::$app->request->post('Products')['id'];
        $count = \Yii::$app->request->post('Products')['count'];
        $type = \Yii::$app->request->post('Products')['type'];

        $productsModel = \Yii::createObject(['class' => ProductComponent::class, 'classModelProducts' => Products::class]);
        $product = $productsModel->getProduct($id);


        \Yii::$app->baskets->changeCount($product, $count, $type);


        return $this->controller->render('index', ['product' => $product]);
    }
}