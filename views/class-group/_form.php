<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ClassGroup $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="class-group-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'number')->textInput(['type'=>'number', 'maxlength' => true])->label('Номер группы') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Название') ?>

    <?= $form->field($model, 'descriptor')->textarea(['rows' => 6])->label('Описание') ?>

    <?= $form->field($model, 'photo')->fileInput()->label('Фото') ?>


    <?= $form->field($model, 'program_id')->dropDownList([(\yii\helpers\ArrayHelper::map(\app\models\Program::find()->all(), 'id', 'title')), 'id'=>'programs']); ?>

<!--    --><?//= $form->field($model, 'program_id')->textInput(['maxlength' => true, 'list'=>'programs', 'name'=>'program', 'type'=>'number'])->label('Программа') ?>
<!--    <datalist id="programs">-->
<!--    --><?php
//        $programs = \app\models\Program::find()->all();
//        foreach ($programs as $item){
//    ?>
<!--            <option value="--><?//=$item['id']?><!--">--><?//=$item['title']?><!--</option>-->
<!--    --><?php //} ?>
<!--    </datalist>-->



    <!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'created_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
