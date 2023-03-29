<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AuthorsCourse $model */

$this->title = 'Create Authors Course';
$this->params['breadcrumbs'][] = ['label' => 'Authors Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
