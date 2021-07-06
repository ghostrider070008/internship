<?php
/**
 * @var $model \app\models\Users
 */
?>

<h4>Смена пароля</h4>


<div class="col-md-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin();?>

    <?=$form->field($model, 'password')->passwordInput()?>
    <?=$form->field($model, 'newPassword')->passwordInput()?>
    <?=$form->field($model, 'newPasswordRepeat')->passwordInput()?>

    <div class="col-md-6">
        <button class="btn btn-default"  type="submit">Сменить пароль</button>
    </div>

    <?php \yii\bootstrap\ActiveForm::end();?>
</div>