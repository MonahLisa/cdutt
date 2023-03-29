<?php
/**
 * @var $model UserHasGroup
 */

use app\models\User;
use app\models\UserHasGroup;

$user_model = User::findOne($model->user_id);
?>
<div class="body">
    <p>
        <?php
        echo $user_model->name;
        ?>
        <?php
        echo $user_model->surname;
        ?>
    </p>
</div>