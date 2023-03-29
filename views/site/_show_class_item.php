<?php
/**
 * @var $model ClassGroup
 * @var $user_model User
 */

use app\models\ClassGroup;
use app\models\User;
use yii\helpers\Html;

//$id = $model->photo;
//$media_model = ProductMedia::findOne(['id' => $id]);
//$user_id = \Yii::$app->user->id;
//$user_model = User::getUser($user_id);
echo \yii\helpers\Html::img('/web/uploads/images/classes/'.$model->photo, ["class" => "card-img-top"]);
//?>
<div class="card-body">
    <h5 class="card-title">
        <?php
        echo $model->title;
        ?>
        <?php
        echo $model->number;
        ?>
    </h5>
    <p class="card-text">
        <?php
        echo $model->descriptor;
        ?>
    </p>

    <div class="d-grid gap-2">
        <?= Html::a('Ученический чат', ['site/teachers-group?id='.$model->id], ['class' => 'btn btn-outline-primary btn-lg']) ?>
    </div>
    <div class="d-grid gap-2">
        <?= Html::a('Родительский чат', ['site/teachers-parent-group?group_id='.$model->id], ['class' => 'btn btn-outline-primary btn-lg']) ?>
    </div>
    <div class="d-grid gap-2">
        <?= Html::a('Редактировать', ['class-group/update?id='.$model->id], ['class' => 'btn btn-outline-primary btn-lg']) ?>
    </div>

<!--    <a class="btn btn-outline-secondary" href="#">--><?//= $model->price ?><!-- Р</a>-->
<!---->
<!--    --><?//= $count = $model->getCount($model->id, $user_model->id) ?>
<!---->
<!--    --><?//= \yii\helpers\Html::a($count? $count :"Купить" , ["/site/buy", "id" => $model->id], ["class" => "btn btn-outline-primary", 'visible' => Yii::$app->user->can("buyProduct")]) ?>
</div>

