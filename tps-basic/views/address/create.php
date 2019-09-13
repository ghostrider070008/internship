<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AddressBase */

$this->title = 'Create Address Base';
$this->params['breadcrumbs'][] = ['label' => 'Address Bases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-base-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
