<?php

namespace app\controllers;


use app\controllers\actions\ChangeCountAction;
use app\controllers\actions\RemoveFromBasketAction;
use yii\base\Controller;
use app\components\ProductComponent;
use app\models\Products;
use app\controllers\actions\ProductPageAction;
use app\controllers\actions\AddToBasketAction;

class ProductController extends Controller
{
    public function actions()
    {
        return [
            'index' => ['class'=>ProductPageAction::class],
            'addtobasket' => ['class' => AddToBasketAction::class],
            'removefrombasket' => ['class' => RemoveFromBasketAction::class],
            'changecount' => ['class' => ChangeCountAction::class],
        ];
    }
}