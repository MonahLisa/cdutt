<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * This is the model class for table "class_group".
 *
 * @property int $id
 * @property int $number
 * @property string $title
 * @property string $descriptor
 * @property string $photo
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $program_id
 * @property int $chapter_id
 * @property int $department_id
 *
 * @property Chat[] $chats
 * @property User $createdBy
 * @property ParentGroup[] $parentGroups
 * @property UserHasGroup[] $userHasClasses
 */
class ClassGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_group';
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
            [['number', 'title', 'descriptor', 'photo', 'program_id'], 'required'],
            [['descriptor'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['number', 'created_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['photo', 'image', 'extensions'=>['png', 'jpg', 'jpeg', 'gif'], 'maxSize'=>10485760],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::class, 'targetAttribute' => ['program_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Номер группы',
            'title' => 'Название группы',
            'descriptor' => 'Описание группы',
            'photo' => 'Фото группы',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Создатель группы',
            'program_id' => 'ID программы',
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::class, ['class_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }



    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::class, ['id' => 'program_id']);
    }


    /**
     * Gets query for [[ParentGroups]].
     *
     * @return ActiveQuery
     */
    public function getParentGroups()
    {
        return $this->hasMany(ParentGroup::class, ['class_id' => 'id']);
    }

    /**
     * Gets query for [[UserHasClasses]].
     *
     * @return ActiveQuery
     */
    public function getUserHasClasses()
    {
        return $this->hasMany(UserHasGroup::class, ['class_id' => 'id']);
    }
}
