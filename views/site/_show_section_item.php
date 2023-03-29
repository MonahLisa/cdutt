<?php
/**
 * @var $model Section
 * @var $user_model User
 * @var $class_model ClassGroup
 */

use app\models\ClassGroup;
use app\models\Department;
use app\models\Section;
use app\models\User;
use yii\helpers\Html;

//$id = $model->photo;
//$media_model = ProductMedia::findOne(['id' => $id]);
//$user_id = \Yii::$app->user->id;
//$user_model = User::getUser($user_id);

?>
<a class="sec-link" href="section?section_id=<?php echo $model->id; ?>"><h4><?php echo $model->title; ?></h4></a>


