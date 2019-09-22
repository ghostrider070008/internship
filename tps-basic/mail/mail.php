<?php

/**
 * @var $token \app\models\Users
 */
$url = \yii\helpers\Url::base(true).'/auth/activation?code='.$token;
?>


<a href='<?=$url?>'>Ссылка для активации аккаунта</a>