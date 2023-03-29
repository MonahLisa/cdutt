<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ChatHasUsers $model */

$this->title = 'Create Chat Has Users';
$this->params['breadcrumbs'][] = ['label' => 'Chat Has Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-has-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
