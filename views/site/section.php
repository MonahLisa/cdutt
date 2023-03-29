<?php

use app\models\Section;
use yii\helpers\Html;

$id = $_GET['section_id'];
$section_model = Section::findOne($id);
$program_model = \app\models\Program::findOne($section_model->program_id);
$user_model = \app\models\User::findOne(['id' => Yii::$app->user->id]);
$this->title = 'Раздел "'.$section_model->title.'"';
?>
<style>
    .main-headline{
        font-size: 50px;
        font-weight: bolder;
    }
    main > .container{
        margin-top: 60px;
    }

    .icon{
        width: 4%;
        margin-right: 1%;
    }

    h1{
        margin-bottom: 50px;
    }
    .icon-plus {
        margin-left: 1%;
        width: 4%;
    }

    .sec-link{
        text-decoration: none;

        cursor: pointer;
    }
</style>
<p class="main-headline"><a href="teacher-program?teacher_id=<?php echo $user_model->id; ?>"><img src="../../web/images/icons/arrow-left-circle%20(1).svg" class="icon"></a><?php echo $program_model->title; ?></p>
<h1><a href="program?program_id=<?php echo $section_model->program_id; ?>"><img src="../../web/images/icons/arrow-left-circle%20(1).svg" class="icon"></a><?php echo $section_model->title; ?></h1>
<!--<h2>Разделы<a href="../section/create?program_id=--><?php //echo $program_model->id; ?><!--"><img src="../../web/images/icons/plus-circle.svg" class="icon-plus"></a></h2>-->
<p>
    <?= Html::a('Теоретическая часть', ['class-group/create'], ['class' => 'btn btn-success']) ?>
</p>

<a class="btn btn-primary" href="tasks?section_id=<?php echo $section_model->id; ?>">Задачи</a>
