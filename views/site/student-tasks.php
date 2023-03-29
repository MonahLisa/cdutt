<?php

use app\models\Section;
use app\models\Task;
use yii\helpers\Html;

$id = $_GET['section_id'];
$section_model = Section::findOne($id);
$program_model = \app\models\Program::findOne($section_model->program_id);
$user_model = \app\models\User::findOne(['id' => Yii::$app->user->id]);
$this->title = 'Задачи раздела "'.$section_model->title.'"';
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

<!--<a href="teacher-program?teacher_id=--><?php //echo $user_model->id; ?><!--"><img src="../../web/images/icons/arrow-left-circle%20(1).svg" class="icon"></a>-->

<p class="main-headline"><?php echo $program_model->title; ?></p>
<h1><a href="student-section?section_id=<?php echo $section_model->id; ?>"><img src="../../web/images/icons/arrow-left-circle%20(1).svg" class="icon"></a>Задачи раздела "<?php echo $section_model->title; ?>" </h1>

<?php
/**
 * @var $data Task[]
 */

?>
<?php
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data,
    'itemView' => '_show_task_item',
    'itemOptions' => ["style" => "width: 30rem; margin-bottom: 3vh;"],

]);
?>

<script>
    let summary = document.querySelector(".summary");
    summary.remove();
</script>
