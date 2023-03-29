<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ParentGroup $model */

$this->title = 'Create Parent Group';
$this->params['breadcrumbs'][] = ['label' => 'Parent Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parent-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
