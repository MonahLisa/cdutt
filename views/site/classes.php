<?php

use app\models\ClassGroup;
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

$this->title = 'Мои группы';
?>
<style>
    .list-view{
        display: flex;
        flex-wrap: wrap;
        gap: 60px;
        /*margin-top: 60px;*/
        flex-direction: row;
        align-items: flex-start;
        width: 100%;
    }

</style>
<div style="margin-top: 50px;">

    <p>
        <?= Html::a('Создать группу', ['class-group/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    /**
     * @var $data ClassGroup[]
     */

    ?>
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $data,
        'itemView' => '_show_class_item',
        'itemOptions' => ["class" => "card", "style" => "width: 18rem;"],

    ]);
    ?>


</div>
<script>
    let summary = document.querySelector(".summary");
    summary.remove();

    // let prodCard = document.querySelector('[data-key]');
    // prodCard.classList.add("card");
</script>