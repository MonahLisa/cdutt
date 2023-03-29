<?php

use app\models\ClassGroup;
use app\models\UserHasGroup;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

$this->title = 'Учебные отделы';
?>
<style>
    main > .container{
        margin-top: 60px;
    }
    .prog-link{
        font-size: 28px;
        text-decoration: none;

        cursor: pointer;
    }
</style>

<h1>Мои программы</h1>
<?php
/**
 * @var $data UserHasGroup[]
 */

?>

<?php
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data,
    'itemView' => '_show_teacher_programs_item',
    'itemOptions' => ["style" => "width: 50rem; margin-bottom: 3vh;"],

]);
?>



<script>
    let summary = document.querySelector(".summary");
    summary.remove();

    // let prodCard = document.querySelector('[data-key]');
    // prodCard.classList.add("card");
</script>