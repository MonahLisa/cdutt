<?php
/**
 * @var $model Chapter
 * @var $user_model User
 * @var $class_model ClassGroup
 * @var $dep_model Department
 */

use app\models\Chapter;
use app\models\ClassGroup;
use app\models\Department;
use app\models\User;
use yii\helpers\Html;

//$id = $model->photo;
//$media_model = ProductMedia::findOne(['id' => $id]);
//$user_id = \Yii::$app->user->id;
//$user_model = User::getUser($user_id);

?>
<a class="chap-link" href="programs?chap_id=<?php echo $model->id; ?>"><?php echo $model->title; ?></a>


