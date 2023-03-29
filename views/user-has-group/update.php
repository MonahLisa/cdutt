<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserHasGroup $model */

$this->title = 'Update User Has Group: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Has Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-has-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
