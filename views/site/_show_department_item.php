<?php
/**
 * @var $model Department
 * @var $user_model User
 * @var $class_model ClassGroup
 */

use app\models\ClassGroup;
use app\models\Department;
use app\models\User;
use yii\helpers\Html;

//$id = $model->photo;
//$media_model = ProductMedia::findOne(['id' => $id]);
//$user_id = \Yii::$app->user->id;
//$user_model = User::getUser($user_id);

?>
<a class="dep-link" href="dep-programs?dep_id=<?php echo $model->id; ?>"><?php echo $model->title; ?></a>


