<?php
/**
 * @var $model ClassGroup
 */

use app\models\ClassGroup;
use app\models\Department;
use app\models\User;
use app\models\UserHasGroup;
use yii\helpers\Html;

//$id = $model->photo;
//$media_model = ProductMedia::findOne(['id' => $id]);
//$user_id = \Yii::$app->user->id;
//$user_model = User::getUser($user_id);
$program_model = \app\models\Program::findOne($model->program_id);
?>
<a class="prog-link" href="program?program_id=<?php echo $program_model->id; ?>"><?php echo $program_model->title; ?></a>



