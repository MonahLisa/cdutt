<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ParentGroup $model */

$this->title = 'Update Parent Group: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Parent Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parent-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
