<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_has_parent_group".
 *
 * @property int $id
 * @property int $user_id
 * @property int $parent_group_id
 *
 * @property ParentGroup $parentGroup
 * @property User $user
 */
class UserHasParentGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_has_parent_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'parent_group_id'], 'required'],
            [['user_id', 'parent_group_id'], 'integer'],
            [['parent_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParentGroup::class, 'targetAttribute' => ['parent_group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'parent_group_id' => 'Parent Group ID',
        ];
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
