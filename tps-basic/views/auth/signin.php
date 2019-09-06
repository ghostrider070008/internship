<?php
/**
 * @var $model \app\models\Users
 */
?>

<h4>Авторизация</h4>
<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin();?>
    <?=$form->field($model, 'email')?>
    <?=$form->field($model, 'password')->passwordInput()?>
    <div class="col-md-6">
        <button class="btn btn-default"  type="submit">Войти</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end();?>
</div>
