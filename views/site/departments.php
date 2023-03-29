<?php

use app\models\ClassGroup;
use app\models\Department;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

$this->title = 'Учебные отделы';
?>
<style>
    .list-view{
        margin-top: 50px;
    }
    .dep-link{
        font-size: 28px;
        text-decoration: none;

        cursor: pointer;
    }
</style>


    <?php
    /**
     * @var $data Department[]
     */

    ?>

    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $data,
        'itemView' => '_show_department_item',
        'itemOptions' => ["style" => "width: 50rem; margin-bottom: 3vh;"],

    ]);
    ?>



<script>
    let summary = document.querySelector(".summary");
    summary.remove();

    // let prodCard = document.querySelector('[data-key]');
    // prodCard.classList.add("card");
</script>