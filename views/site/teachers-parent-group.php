<?php

use app\models\UserHasGroup;
use yii\helpers\Html;

$id = $_GET['group_id'];
$group_model = \app\models\ClassGroup::findOne(['id' => $id]);
$parent_group_model = \app\models\ParentGroup::findOne(['class_id' => $id]);
?>
<head>
    <link rel="stylesheet" href="../../web/css/teachers-group-styles.css">
</head>

<div class="body">
    <?php
    echo \yii\helpers\Html::img('/web/uploads/images/classes/'.$parent_group_model->photo, ["style" => "width: 300px; height: 300px; border-radius: 50%;"]);
    ?>
    <h1>
        <?php
        echo $parent_group_model->title;
        ?>
    </h1>
    <h2>
        <?php
        echo $parent_group_model->descriptor;
        ?>
    </h2>


    <div class="add-user">
        <p class="users-headline">Родители</p>
        <?= Html::a('<img src="../../web/images/icons/plus-circle.svg" class="icon" ">', ['user-has-group/create?group_id='.$id], []) ?>
    </div>


</div>



