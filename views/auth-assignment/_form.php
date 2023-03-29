<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AuthAssignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_name')->dropDownList((\yii\helpers\ArrayHelper::map(\app\models\AuthItem::find()->all(), 'name', 'description')))->label('Роль'); ?>

    <?= $form->field($model, 'user_id')->dropDownList((\yii\helpers\ArrayHelper::map(\app\models\User::find()->all(), 'id', 'login')))->label('Пользователь'); ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
