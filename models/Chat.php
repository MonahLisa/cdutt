<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int|null $class_id
 * @property int|null $parent_group_id
 *
 * @property ClassGroup $class
 * @property Message[] $messages
 * @property ParentGroup $parentGroup
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'parent_group_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassGroup::class, 'targetAttribute' => ['class_id' => 'id']],
            [['parent_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParentGroup::class, 'targetAttribute' => ['parent_group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => 'Class ID',
            'parent_group_id' => 'Parent Group ID',
        ];
    }

    /**
     * Gets query for [[Class]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(ClassGroup::class, ['id' => 'class_id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::class, ['chat_id' => 'id']);
    }

    /**
     * Gets query for [[ParentGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentGroup()
    {
        return $this->hasOne(ParentGroup::class, ['id' => 'parent_group_id']);
    }


}
