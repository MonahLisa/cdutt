<?php

use app\models\Section;
use yii\helpers\Html;

$id = $_GET['group_id'];
$group_model = \app\models\ClassGroup::findOne($id);
$program_model = \app\models\Program::findOne($group_model->program_id);
$user_model = \app\models\User::findOne(['id' => Yii::$app->user->id]);
$this->title = 'Программа "'.$program_model->title.'"';
?>
<style>
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

<h1><a href="students-group?id=<?php echo $group_model->id; ?>"><img src="../../web/images/icons/arrow-left-circle%20(1).svg" class="icon"></a><?php echo $program_model->title; ?></h1>
<h2>Разделы</h2>

<?php
/**
 * @var $data Section[]
 */

?>
<?php
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data,
    'itemView' => '_show_student_section_item',
    'itemOptions' => ["style" => "width: 30rem; margin-bottom: 3vh;"],

]);
?>



<script>
    let summary = document.querySelector(".summary");
    summary.remove();
</script>
