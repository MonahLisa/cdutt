<?php

use app\models\ClassGroup;
use app\models\Department;
use app\models\Program;
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

$dep_id = $_GET['dep_id'];
$dep_model = \app\models\Department::findOne(['id' => $dep_id]);


$this->title = $dep_model->title;
?>

<!--<div class="d-grid gap-2">-->
<!--    --><?//= Html::a('Назад', ['departments'], ['class' => 'btn btn-primary', 'style'=>'width: 30%;']) ?>
<!--</div>-->
<style>
    main > .container{
        margin-top: 50px;
    }
    .prog-link{
        font-size: 28px;
        text-decoration: none;
        color: #2c3034;
    }

    .icon{
        width: 5%;
        margin-right: 1%;
    }
</style>


<?php
/**
 * @var $data Program[]
 */

?>
<h1><?= Html::a('<img src="../../web/images/icons/arrow-left-circle%20(1).svg" class="icon" ">', ['departments'], []) ?><?php echo $dep_model->title; ?>. Об отделе</h1>
<div style="height: 400px;"></div>
<h2>Программы отдела</h2>
<?php
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data,
    'itemView' => '_show_program_item',
    'itemOptions' => ["style" => "width: 50rem; margin-bottom: 2vh;"],

]);
?>



<script>
    let summary = document.querySelector(".summary");
    summary.remove();

    // let prodCard = document.querySelector('[data-key]');
    // prodCard.classList.add("card");
</script>