<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "parent_group".
 *
 * @property int $id
 * @property string $title
 * @property string $descriptor
 * @property string $photo
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $class_id
 *
 * @property Chat[] $chats
 * @property ClassGroup $class
 * @property User $createdBy
 * @property UserHasParentGroup[] $userHasParentGroups
 */
class ParentGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parent_group';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'descriptor', 'photo'], 'required'],
            [['descriptor'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'class_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['photo', 'image', 'extensions'=>['png', 'jpg', 'jpeg', 'gif'], 'maxSize'=>10485760],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClassGroup::class, 'targetAttribute' => ['class_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'descriptor' => 'Descriptor',
            'photo' => 'Photo',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'class_id' => 'Class ID',
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::class, ['parent_group_id' => 'id']);
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
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UserHasParentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasParentGroups()
    {
        return $this->hasMany(UserHasParentGroup::class, ['parent_group_id' => 'id']);
    }
}
