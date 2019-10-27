<?php
use app\components\BasketsComponent;
use app\models\Baskets;
?>



<?= $product -> product_name ?>


<?php
/*$basketsModel = \Yii::createObject(['class' => BasketsComponent::class, 'classModelBaskets' => Baskets::class]);

$usersBasket = $basketsModel -> getUsersBasket(\Yii::$app->session['__id']);

var_dump($usersBasket['product_id']);*/
?>





<?php /*var_dump(\Yii::$app->request->cookies)*/;?>

<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
            'action' => '/product/addtobasket',
            'method' => 'POST',
    ]);?>

    <?=$form->field($product, 'id')->hiddenInput()->label(false); ?>
    <?=$form->field($product, 'count'); ?>

    <div class="col-md-6">
        <button class="btn btn-default"  type="submit">Добавить в корзину</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end();?>
</div>

<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'action' => '/product/removefrombasket',
        'method' => 'POST',
    ]);?>

    <?=$form->field($product, 'id')->hiddenInput()->label(false); ?>

    <div class="col-md-6">
        <button class="btn btn-default"  type="submit">Удалить из корзины</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end();?>
</div>

<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'action' => '/product/changecount',
        'method' => 'POST',
    ]);?>

    <?=$form->field($product, 'id')->hiddenInput()->label(false); ?>
    <?=$form->field($product, 'type')->hiddenInput(['value' => 1])->label(false); ?>
    <?=$form->field($product, 'count'); ?>

    <div class="col-md-6">
        <button class="btn btn-default"  type="submit">+</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end();?>
</div>

<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'action' => '/product/changecount',
        'method' => 'POST',
    ]);?>

    <?=$form->field($product, 'id')->hiddenInput()->label(false); ?>
    <?=$form->field($product, 'type')->hiddenInput(['value' => 2])->label(false); ?>
    <?=$form->field($product, 'count'); ?>

    <div class="col-md-6">
        <button class="btn btn-default"  type="submit">-</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end();?>
</div>
