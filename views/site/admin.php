<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

$this->title = 'Админ-панель';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="margin-top: 50px;">

    <p>
        <?= Html::a('Классы', ['class-group/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <p>
        <?=Html::a('Права пользователей', ['auth-assignment/index'], ['class' => 'btn btn-success']);?>
    </p>



</div>