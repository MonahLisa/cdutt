<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserHasGroup $model */

$this->title = 'Create User Has Group';
$this->params['breadcrumbs'][] = ['label' => 'User Has Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
