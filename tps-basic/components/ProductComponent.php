<?php

namespace app\components;


use app\base\BaseComponent;
use app\models\Products;

class ProductComponent extends BaseComponent
{
    public $classModelProducts;

    public function getClassModelProducts()
    {
        return new $this->classModelProducts();
    }

    public function getProduct($id)
    {
        $product = Products::find()->andWhere(['id' => $id])->one();

        return $product;
    }
}