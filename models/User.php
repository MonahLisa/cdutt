<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $name
 * @property string $surname
 * @property string|null $avatar
 * @property string|null $birthday
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string $phone
 * @property int $status
 * @property int $role
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Chat[] $chats
 * @property ClassGroup[] $classGroups
 * @property Message[] $messages
 * @property ParentGroup[] $parentGroups
 * @property UserHasClass[] $userHasClasses
 * @property UserHasParentGroup[] $userHasParentGroups
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

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
            [['login', 'name', 'surname', 'auth_key', 'password_hash', 'email', 'phone'], 'required'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['status', 'role'], 'integer'],
            [['login', 'avatar', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['name', 'surname'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['login'], 'unique'],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['phone'], 'string', 'max' => 15],
            [['password_reset_token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'avatar' => 'Аватар',
            'birthday' => 'День рождения',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'phone' => 'Номер телефона',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ClassGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClassGroups()
    {
        return $this->hasMany(ClassGroup::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ParentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentGroups()
    {
        return $this->hasMany(ParentGroup::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[UserHasClasses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasClasses()
    {
        return $this->hasMany(UserHasClass::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserHasParentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasParentGroups()
    {
        return $this->hasMany(UserHasParentGroup::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByUsername($login)
    {
        return self::findOne(['login' => $login]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    /**
     * Generates "remember me" authentication key
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    static function getUser($id){
        return self::find()->where(['id' => $id])->all();

    }
}
