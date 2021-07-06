<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Личная информация';
$this->params['breadcrumbs'][] = $this->title;

/*var_dump($dataProvider->models[0]['username']);*/
?>


<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        /*'filterModel' => $searchModel,*/
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/

            /*'id',*/
            'username',
            'email:email',
            /*'password_hash',*/
            /*'token',*/
            'firstname',
            'lastname',
            'surname',
            'phoneNumber',
            //'createAt',
            //'updateAt',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
