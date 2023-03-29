<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AuthorsCourse $model */

$this->title = 'Update Authors Course: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Authors Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authors-course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
