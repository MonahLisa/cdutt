<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <form class="login-form" method="post">
        <div class="col-6 mx-auto">
            <h1 style="font-family: 'JetBrains Mono', monospace;"><?= Html::encode($this->title) ?></h1>

            <p>Введите данные, чтобы войти</p>


            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg form-primary', 'placeholder' => 'Логин'])->hint('Введите ваш логин')->label(''); ?>

            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-lg', 'placeholder' => 'Пароль'])->hint('Введите ваш пароль')->label(''); ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->label('Запомнить') ?>

            <div class="form-group">
                <div class="d-grid gap-2 mx-auto">

                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button', 'type' => 'button']) ?>

                    <?php echo '<button id="button-reg"  onclick="window.location=\'signup\'" class="btn btn-outline-primary">Регистрация</button>'; ?>

                </div>
            </div>
        </div>
    </form>

    <?php ActiveForm::end(); ?>

</div>
