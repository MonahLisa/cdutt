<?php

use app\models\UserHasGroup;
use yii\helpers\Html;

$id = $_GET['id'];
$group_model = \app\models\ClassGroup::findOne(['id' => $id]);
$this->title = 'Группа '.$group_model->number;
?>
<head>
    <link rel="stylesheet" href="../../web/css/teachers-group-styles.css">
</head>
<div class="body">
    <?php
    echo \yii\helpers\Html::img('/web/uploads/images/classes/'.$group_model->photo, ["style" => "width: 300px; height: 300px; border-radius: 50%;"]);
    ?>
    <h1>
        Группа
        <?php
        echo $group_model->number;
        ?>
    </h1>
    <h2>
        <?php
        echo $group_model->title;
        ?>
    </h2>
    <p>
        <?= Html::a('Зайти в чат', ['site/chat?class_id='.$id.'#last-message'], ['class' => 'btn btn-success']) ?>
    </p>


    <div class="add-user">
        <p class="users-headline">Ученики</p>
        <?= Html::a('<img src="../../web/images/icons/plus-circle.svg" class="icon" ">', ['user-has-group/create?group_id='.$id], []) ?>
    </div>
    <?php
    /**
     * @var $data UserHasGroup[]
     */

    ?>

    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $data,
        'itemView' => '_show_users_in_class_item',
        'itemOptions' => ["class" => "card", "style" => "width: 18rem;"],

    ]);
    ?>

</div>



