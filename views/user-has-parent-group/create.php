<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserHasParentGroup $model */

$this->title = 'Create User Has Parent Group';
$this->params['breadcrumbs'][] = ['label' => 'User Has Parent Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-parent-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
