<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClassGroup $model */

$this->title = 'Обновить группу ' . $model->number;
//$this->params['breadcrumbs'][] = ['label' => 'Class Groups', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="class-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
