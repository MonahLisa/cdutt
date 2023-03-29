<?php

use app\models\Message;
use app\models\User;
use app\models\UserHasGroup;
use yii\db\Expression;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$class_id = $_GET['class_id'];
$chat_model = \app\models\Chat::findOne(['class_id' => $class_id]);
$group_model = \app\models\ClassGroup::findOne(['id' => $class_id]);
$this->title = 'Чат группы '.$group_model->number;
?>
<head>
    <link rel="stylesheet" href="../../web/css/chat-style.css">
   
</head>
<!--<h1>Чат группы-->
<!--    --><?php
//    echo $group_model->number;
//    ?>
<!--</h1>-->
<body>
<div class="--dark-theme" id="chat">

<!--    Поле для сообщений-->
    <div class="chat__conversation-board" id="chat__conversation-board">
        <?php
        $row = Message::find()->all();
        foreach ($row as $item){
            if($item['chat_id'] === $chat_model->id){
                if($item['user_id'] === Yii::$app->user->id){
                    $user_model = User::findOne($item['user_id']);


        ?>
            <div class="chat__conversation-board__message-container reversed" id="<?=$item['id']?>">
                <div class="chat__conversation-board__message__person">
                    <div class="chat__conversation-board__message__person__avatar"><img src="../../web/uploads/images/users/<?=$user_model->avatar?>" alt="Monika Figi"/></div><span class="chat__conversation-board__message__person__nickname">Monika Figi</span>
                </div>
                <div class="chat__conversation-board__message__context">
                    <div class="chat__conversation-board__message__bubble"> <span><?=$item['body']?></span></div>
                </div>
            </div>
        <?php
                }else{
                    $user_model = User::findOne($item['user_id']);
        ?>
                <div class="chat__conversation-board__message-container" id="<?=$item['id']?>">
                    <div class="chat__conversation-board__message__person">
                        <div class="chat__conversation-board__message__person__avatar"><img src="../../web/uploads/images/users/<?=$user_model->avatar?>" alt="Monika Figi"/></div><span class="chat__conversation-board__message__person__nickname">Monika Figi</span>
                    </div>
                    <div class="chat__conversation-board__message__context">
                        <div class="chat__conversation-board__message__bubble"> <span><?=$item['body']?></span></div>
                    </div>
                </div>

        <?php
                }
            }
        }
        ?>

    </div>

<!--    Панель отправки сообщений-->
    <div class="chat__conversation-panel">
<!--        <div class="chat__conversation-panel__container">-->
<!--            <button class="chat__conversation-panel__button panel-item btn-icon add-file-button">-->
<!--                <svg class="feather feather-plus sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">-->
<!--                    <line x1="12" y1="5" x2="12" y2="19"></line>-->
<!--                    <line x1="5" y1="12" x2="19" y2="12"></line>-->
<!--                </svg>-->
<!--            </button>-->
<!--            <button class="chat__conversation-panel__button panel-item btn-icon emoji-button">-->
<!--                <svg class="feather feather-smile sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">-->
<!--                    <circle cx="12" cy="12" r="10"></circle>-->
<!--                    <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>-->
<!--                    <line x1="9" y1="9" x2="9.01" y2="9"></line>-->
<!--                    <line x1="15" y1="9" x2="15.01" y2="9"></line>-->
<!--                </svg>-->
<!--            </button>-->
<!--            <input class="chat__conversation-panel__input panel-item" placeholder="Type a message..."/>-->

            <?php
            /**
             * @var $message Message[]
            */
            ?>

        <?php

        if( isset( $_POST['send-message'] )) {

            echo $_POST['inputMessage']['message'];

            $message_model = new Message();
            $message_model->chat_id=$chat_model->id;
            $message_model->body=$_POST['message'];
            $message_model->user_id=Yii::$app->user->id;
            $message_model->time_created = new Expression('NOW()');

            $message_model->save();
            header("Refresh: 0");
        }
        ?>

        <?php echo Html :: csrfMetaTags(); ?>
            <form name="chat__conversation-panel__container" class="chat__conversation-panel__container" method="post">
                <?php echo Html :: hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []); ?>
            <?= Html::input('text', 'message', $message->body, ['class' => 'chat__conversation-panel__input panel-item', 'name'=>'inputMessage', 'placeholder'=>'Type a message...']) ?>
            <button name="send-message" class="chat__conversation-panel__button panel-item btn-icon send-message-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" data-reactid="1036">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
            </form>
<!--        </div>-->
    </div>

</div>
<script src="../../web/script/chat-script.js"></script>
</body>





