<?php
$user_id = Yii::$app->user->id;
$user_model = \app\models\User::findOne($user_id);
?>

<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Профиль';
//$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="/web/css/user-profile.css">
<style>
    .personal-image {
        text-align: center;
    }
    .personal-image input[type="file"] {
        display: none;
    }
    .personal-figure {
        position: relative;
        width: 100%;
        height: 30vh;
    }
    .personal-avatar {
        cursor: pointer;
        width: 100%;
        height: 30vh;
        box-sizing: border-box;
        border-radius: 100%;
        border: 2px solid transparent;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
        transition: all ease-in-out .3s;
    }
    .personal-avatar:hover {
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.5);
    }
    .personal-figcaption {
        cursor: pointer;
        position: absolute;
        top: 0;
        width: inherit;
        height: inherit;
        border-radius: 100%;
        opacity: 0;
        background-color: rgba(0, 0, 0, 0);
        transition: all ease-in-out .3s;
    }
    .personal-figcaption:hover {
        opacity: 1;
        background-color: rgba(0, 0, 0, .7);
    }
    .personal-figcaption > img {
        margin-top: 25%;
        width: 50%;
        height: 50%;
    }
</style>

<div class="user-profile-index">

    <div class = "user_container">
        <div class = "f_column">

            <div class="personal-image">
                <label class="label">
                    <input type="file" />

                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($user_model, 'avatar')->fileInput() ?>
                    <?php ActiveForm::end(); ?>
                    <div class="personal-figure">
                        <img src="/web/uploads/images/users/<?php echo $user_model->avatar; ?>" class="personal-avatar" alt="avatar">
                        <div class="personal-figcaption">
                            <img src="/web/images/icons/camera_white.svg" alt="">
                        </div>
                    </div>
                </label>
            </div>


<!--            <p class = "profile_friends">0 друзей 0 подписчиков</p>-->

            <a class = "profile_friend_button" href="teacher-program?teacher_id=<?php echo $user_model->id; ?>" type = "button">
                <p class = "friend_button_text" style = "margin: 20px 0">Мои программы</p>
            </a>

            <a class = "profile_friend_button" href="tutorial-for-teachers" type = "button">
                <p class = "friend_button_text" style = "margin: 20px 0">Инструкция для педагогов</p>
            </a>

<!--            <a class = "profile_friend_button" href="" type = "button">-->
<!--                <svg class = "friend_button_ico" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <path d="M33.3335 43.75V39.5833C33.3335 37.3732 32.4555 35.2536 30.8927 33.6908C29.3299 32.128 27.2103 31.25 25.0002 31.25H10.4168C8.20669 31.25 6.08708 32.128 4.52427 33.6908C2.96147 35.2536 2.0835 37.3732 2.0835 39.5833V43.75" fill="#1ABAFF"/>-->
<!--                    <path d="M33.3335 43.75V39.5833C33.3335 37.3732 32.4555 35.2536 30.8927 33.6908C29.3299 32.128 27.2103 31.25 25.0002 31.25H10.4168C8.20669 31.25 6.08708 32.128 4.52427 33.6908C2.96147 35.2536 2.0835 37.3732 2.0835 39.5833V43.75H33.3335Z" stroke="#1ABAFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M17.7083 25.6667C22.3107 25.6667 26.0417 21.9357 26.0417 17.3333C26.0417 12.731 22.3107 9 17.7083 9C13.106 9 9.375 12.731 9.375 17.3333C9.375 21.9357 13.106 25.6667 17.7083 25.6667Z" fill="#1ABAFF" stroke="#1ABAFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M41.6665 19V31.5" stroke="#1ABAFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                    <path d="M47.9165 25.25H35.4165" stroke="#1ABAFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                </svg>-->
<!--                <p class = "friend_button_text" style = "margin: 20px 0">Добавить друзей</p>-->
<!---->
<!---->
<!--            </a>-->

        </div>

        <div class = "profile_name">
            <h1 class="profile_nick"><?php echo $user_model->login; ?></h1>
            <p class = "profile_name"><?php echo $user_model->name; ?> <?php echo $user_model->surname; ?></p>

            <p class="profile_phone"><?php echo $user_model->phone; ?></p>
            <a class = "profile_redact" type = "button" href="../user/update?id=<?php echo $user_model->id; ?>">
                <svg class = "redact_button_ico" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10C0 4.47715 4.47715 0 10 0H40C45.5228 0 50 4.47715 50 10V40C50 45.5228 45.5228 50 40 50H10C4.47715 50 0 45.5228 0 40V10ZM42 44V39.3333C42 36.858 41.0781 34.484 39.4372 32.7337C37.7962 30.9833 35.5706 30 33.25 30H15.75C13.4294 30 11.2038 30.9833 9.56282 32.7337C7.92187 34.484 7 36.858 7 39.3333V44H42ZM34 17C34 21.9706 29.9706 26 25 26C20.0294 26 16 21.9706 16 17C16 12.0294 20.0294 8 25 8C29.9706 8 34 12.0294 34 17Z" fill="#1ABAFF"/>
                </svg>
                <p class = "redact_button_text" style = "margin: 10px 0">Изменить профиль</p>


            </a>
        </div>


    </div>
</div>


