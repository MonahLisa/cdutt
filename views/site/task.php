<?php

use app\models\Message;
use yii\db\Expression;
use yii\helpers\Html;

$task_id = $_GET['task_id'];
$task_model = \app\models\Task::findOne($task_id);
$this->title = 'Задача № '.$task_model->id.' "'.$task_model->title.'"';
?>


<h1>Задача № <?php echo $task_model->id; ?> "<?php echo $task_model->title; ?>"<a name="send-massage"><img title="Отправьте ссылку на задание в чат" src="../../web/images/icons/link%20(1).svg"></a></h1>
<h2><?php echo $task_model->body; ?></h2>
<input type="file">
<p>
    <?= Html::a('Отправить на проверку', ['class-group/create'], ['class' => 'btn btn-success']) ?>
</p>

