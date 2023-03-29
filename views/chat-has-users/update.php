<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ChatHasUsers $model */

$this->title = 'Update Chat Has Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chat Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chat-has-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
