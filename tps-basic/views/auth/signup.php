<?php
/**
 * @var $model \app\models\Users
 */
?>

<h4>Регистрация</h4>


<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin();?>
    <?=$form->field($model, 'username')?>
    <?=$form->field($model, 'email')?>
    <?=$form->field($model, 'password')?>
    <?=$form->field($model, 'passwordRepeat')?>
    <?=$form->field($model, 'surname')?>
    <?=$form->field($model, 'firstname')?>
    <?=$form->field($model, 'lastname')?>
    <?=$form->field($model, 'phoneNumber')?>
    <div class="col-md-6">
        <button class="btn btn-default"  type="submit">Регистрация</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end();?>
</div>