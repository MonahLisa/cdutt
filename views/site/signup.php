<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
        <div class="col-6 mx-auto">
            <h1 style="font-family: 'JetBrains Mono', monospace;">Приветствуем вас на платфоре ЦДЮТТ!</h1>
            <p>Заполните форму, чтобы зарегистрироваться</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'login')->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg', 'placeholder' => 'Логин'])->label(''); ?>
            <?= $form->field($model, 'name')->textInput(['class' => 'form-control form-control-lg', 'placeholder' => 'Имя'])->label(''); ?>
            <?= $form->field($model, 'surname')->textInput(['class' => 'form-control form-control-lg', 'placeholder' => 'Фамилия'])->label(''); ?>
            <?= $form->field($model, 'email')->textInput(['class' => 'form-control form-control-lg', 'type' => 'email', 'placeholder' => 'Почта'])->label(''); ?>
            <?= $form->field($model, 'phone')->textInput(['class' => 'form-control form-control-lg form-primary', 'type' => 'phone', 'placeholder' => 'Номер телефона'])->label(''); ?>
            <?=$form->field($model, 'role')->label('Ваш статус')->radioList(['7' => 'Учитель', '5' => 'Ученик', '6'=>'Родитель'],['value'=>7])?>

            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-lg form-primary', 'placeholder' => 'Пароль'])->label(''); ?>
            <div class="d-grid gap-2 mx-auto">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


