<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserHasGroup $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-has-group-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'user_id')->dropDownList((\yii\helpers\ArrayHelper::map(\app\models\User::find()->all(), 'id', 'name')))->label(''); ?>

<!--    --><?//= $form->field($model, 'group_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
