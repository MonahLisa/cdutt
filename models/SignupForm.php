<?php
namespace app\models;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $login;
    public $name;
    public $surname;
    public $avatar;
    public $email;
    public $phone;
    public $password;
    public $status;
    public $role;




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['login', 'trim'],
            ['login', 'required'],
            ['login', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот логин уже занят.'],
            ['login', 'string', 'min' => 4, 'max' => 255],

            ['role', 'integer'],

            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'max' => 100],

            ['surname', 'trim'],
            ['surname', 'required'],
            ['surname', 'string', 'max' => 100],

            ['email', 'trim'],
            [['created_at', 'updated_at'], 'safe'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот адрес электронной почты уже занят.'],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'max' => 15],
            ['phone', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот номер телефона уже занят.'],


            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['avatar', 'image', 'extensions'=>['png', 'jpg', 'jpeg', 'gif'], 'maxSize'=>10485760],

        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->login = $this->login;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->avatar = 'user_avatar.png';
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->role = $this->role;
        $user->setPassword($this->password);
        $user->generateAuthKey();
//        var_dump($user);

        return $user->save() ? $user : null;
    }
}

