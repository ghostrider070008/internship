<?php

namespace app\components;


use app\base\BaseComponent;
use app\models\Baskets;
use app\models\Products;
use yii\helpers\ArrayHelper;

class BasketsComponent extends BaseComponent
{
    public $classModelBaskets;

    public function getClassModelBaskets()
    {
        return new $this->classModelBaskets();
    }

    public function findInBasket($productId)
    {
        $product = Baskets::find()->andWhere(['product_id' => $productId, 'user_id' => \Yii::$app->session['__id']])->one();

        return $product;
    }

    public function addToBasket(Products &$product, $count)
    {

        if (\Yii::$app->rbac->canCreateData()) {

            //авторизованный пользователь

            $basketsModel = \Yii::createObject(['class' => BasketsComponent::class, 'classModelBaskets' => Baskets::class]);
            $basket = $basketsModel->getClassModelBaskets();

            if (!$this->findInBasket($product->id)) {
                $basket->product_id = $product->id;
                $basket->count = $count;//
                $basket->user_id = \Yii::$app->session['__id'];
            } else {
                $basket = $this->findInBasket($product->id);
                $basket -> count = $basket -> count + $count;//
            }

            $basket -> total_price = $product->price * $basket->count;

            if (!$basket->save()) {
                return false;
            }
            return true;

        } else {

            //гость

            $cookies = \Yii::$app->request->cookies;

            if(isset($cookies['basket'])) {
                $basket = $cookies['basket']->value;
            } else {
                $basket = [];
            }


            if(ArrayHelper::getValue($basket, $product->id)){
                $oldCount = ArrayHelper::getValue($basket, $product->id.'.count');//---
                $count = $count + $oldCount;
            }

            $basket[$product->id] = [
                'count' => $count,
                'price' => $product->price * $count
            ];

            $cookies = \Yii::$app->response->cookies;

            $cookies->remove('basket');
            $cookies->add(new \yii\web\Cookie([
                'name' => 'basket',
                'value' => $basket
            ]));



        }

    }

    public function removeFromBasket(Products &$product)
    {

        if (\Yii::$app->rbac->canCreateData()) {

            //авторизованный пользователь

            $basketsModel = \Yii::createObject(['class' => BasketsComponent::class, 'classModelBaskets' => Baskets::class]);

            $basket = $basketsModel->findInBasket($product->id);

            if (!$basket->delete()) {
                return false;
            }
            return true;
        } else {

            //гость

            $cookies = \Yii::$app->request->cookies;

            $basket = $cookies['basket']->value;

            ArrayHelper::remove($basket, $product->id);

            $cookies = \Yii::$app->response->cookies;

            $cookies->remove('basket');
            $cookies->add(new \yii\web\Cookie([
                'name' => 'basket',
                'value' => $basket
            ]));

        }

    }

    public function changeCount(Products &$product, $count, $type)
    {

        if (\Yii::$app->rbac->canCreateData()) {

            //авторизованный пользователь

            $basketsModel = \Yii::createObject(['class' => BasketsComponent::class, 'classModelBaskets' => Baskets::class]);

            $basket = $basketsModel->findInBasket($product->id);
            $actualCount = $basket->count;

            if ($type == 2) {
                if (!$actualCount - $count <= 0) {
                    $basket->count = $basket->count - $count;
                } else {
                    if (!$basket->delete()) {
                        return false;
                    }
                    return true;
                }
            } else {
                $basket->count = $basket->count + $count;
            }

            $basket->total_price = $basket->total_price * $basket->count - $count;

            if (!$basket->save()) {
                return false;
            }
            return true;
        } else {

            //гость

            $cookies = \Yii::$app->request->cookies;

            $basket = $cookies['basket']->value;
            $oldCount = ArrayHelper::getValue($basket, $product->id.'.count');//---

            if ($type == 2) {
                if (!$oldCount - $count<=0) {
                    $count = $oldCount - $count;
                } else {
                    if (!$basket->delete()) {
                        return false;
                    }
                    return true;
                }

            } else {
                $count = $oldCount + $count;
            }

            $basket[$product->id] = [
                'count' => $count,
                'price' => $product->price * $count
            ];

            $cookies = \Yii::$app->response->cookies;

            $cookies->remove('basket');
            $cookies->add(new \yii\web\Cookie([
                'name' => 'basket',
                'value' => $basket
            ]));
        }

    }


    public function getUsersBasket($userId)
    {
        //$basketsModel = \Yii::createObject(['class' => BasketsComponent::class, 'classModelBaskets' => Baskets::class]);
        $usersBasket = Baskets::find()->andWhere(['user_id' => $userId])->all();
        return $usersBasket;
    }


    public function mergeBaskets()
    {
        $cookies = \Yii::$app->request->cookies;

        if ($basket = $cookies['basket']->value) {

            $guestBasket = $basket = $cookies['basket']->value;

            $basketsModel = \Yii::createObject(['class' => BasketsComponent::class, 'classModelBaskets' => Baskets::class]);

            $usersBasket = $basketsModel -> getUsersBasket(\Yii::$app->session['__id']);

            if ($usersBasket) {

               foreach ($usersBasket as $item => $value) {
                   if (ArrayHelper::keyExists($value['product_id'], $guestBasket)) {
                       $productsModel = \Yii::createObject(['class' => ProductComponent::class, 'classModelProducts' => Products::class]);
                       $product = $productsModel->getProduct($value['product_id']);

                       $addCount = ArrayHelper::getValue($guestBasket, $value['product_id'].'.count');
                       $basketsModel -> changeCount($product, $addCount, 1);
                   } else {
                       $productsModel = \Yii::createObject(['class' => ProductComponent::class, 'classModelProducts' => Products::class]);
                       $product = $productsModel->getProduct($value['product_id']);

                       $count = ArrayHelper::getValue($guestBasket, $value['product_id'].'.count');

                       $basketsModel->addToBasket($product, $count);
                   }
               }
            }

            $cookies = \Yii::$app->response->cookies;

            $cookies->remove('basket');

        }

        return true;
    }

}