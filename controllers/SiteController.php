<?php

namespace app\controllers;

use app\models\Chapter;
use app\models\ClassGroup;
use app\models\Department;
use app\models\Program;
use app\models\Section;
use app\models\SignupForm;
use app\models\Task;
use app\models\UserHasGroup;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Console;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'admin', 'index', 'waiting'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow'         => true, // Разрешаем доступ.
                        'actions'       => ['admin'], // К действию auth-assignment/index
                        'roles'         => ['@'], // Только аутентифицированному пользователю.
//                        'ips'           => ['127.0.0.1'], // С IP-адресом "127.0.0.1".
                        'verbs'         => ['GET', 'POST', 'PUT'], // Через HTTP методы GET, POST и PUT.
                        'matchCallback' => function () {
                            // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                            return Yii::$app->user->can('adminPanel');
//                            return Yii::$app->user->identity->role == User::ROLE_ADMIN;
                        },
                        'denyCallback'  => function () {
                            // Если пользователь не подпадает под все условия, то завершаем работы и выдаем своё сообщение.
                            die('Эта страница доступна только администратору!');
                        },
                    ],
                    [
                        'allow'         => true, // Разрешаем доступ.
                        'actions'       => ['index'], // К действию auth-assignment/index
                        'roles'         => ['@'], // Только аутентифицированному пользователю.
//                        'ips'           => ['127.0.0.1'], // С IP-адресом "127.0.0.1".
                    ],
                    [
                        'allow'         => true, // Разрешаем доступ.
                        'actions'       => ['waiting'], // К действию auth-assignment/index
                        'roles'         => ['@'], // Только аутентифицированному пользователю.
//                        'ips'           => ['127.0.0.1'], // С IP-адресом "127.0.0.1".
                        'verbs'         => ['GET', 'POST', 'PUT'], // Через HTTP методы GET, POST и PUT.
                        'matchCallback' => function () {
                            // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                            return Yii::$app->user->can('user');
//                            return Yii::$app->user->identity->role == User::ROLE_ADMIN;
                        },
                        'denyCallback'  => function () {
                            // Если пользователь не подпадает под все условия, то завершаем работы и выдаем своё сообщение.
                            die('Эта страница не доступна');
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];



    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionClasses()
    {
        $id_user = Yii::$app->user->id;
        $query = ClassGroup::find()->where(['created_by' => $id_user]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('classes', ['data' => $dataProvider]);
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionStudentGroups()
    {
        $id_user = Yii::$app->user->id;
        $query = UserHasGroup::find()->where(['user_id' => $id_user]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('student-groups', ['data' => $dataProvider]);
    }








    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTeachersGroup()
    {
        $id_user = Yii::$app->user->id;
        $id = $_GET['id'];
//        $query = ClassGroup::find()->where(['created_by' => $id_user]);
        $query = UserHasGroup::find()->where(['group_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('teachers-group', ['data' => $dataProvider]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionStudentsGroup()
    {
        $id_user = Yii::$app->user->id;
        $id = $_GET['id'];
//        $query = ClassGroup::find()->where(['created_by' => $id_user]);
        $query = UserHasGroup::find()->where(['group_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('students-group', ['data' => $dataProvider]);
    }



    public function actionTeachersParentGroup()
    {
        return $this->render('teachers-parent-group');
    }

    public function actionChat()
    {
        return $this->render('chat');
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDepartments()
    {
        $query = Department::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('departments', ['data' => $dataProvider]);
    }




    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDepPrograms()
    {
        $dep_id = $_GET['dep_id'];
        $query = Program::find()->where(['department_id' => $dep_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('dep-programs', ['data' => $dataProvider]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionChapters()
    {

        $query = Chapter::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('chapters', ['data' => $dataProvider]);
    }



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionPrograms()
    {
        $chap_id = $_GET['chap_id'];
        $query = Program::find()->where(['chapter_id' => $chap_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);
//        $items = Product::find()->all();
        return $this->render('programs', ['data' => $dataProvider]);
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTeacherProfile()
    {

        return $this->render('teacher-profile');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTeacherProgram()
    {
        $teacher_id = $_GET['teacher_id'];
        $query = ClassGroup::find()->where(['created_by' => $teacher_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);

        return $this->render('teacher-program', ['data' => $dataProvider]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTutorialForTeachers()
    {
        return $this->render('tutorial-for-teachers');
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionProgram()
    {
        $id = $_GET['program_id'];
        $query = Section::find()->where(['program_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);
        return $this->render('program', ['data' => $dataProvider]);
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionStudentProgram()
    {
        $id = $_GET['group_id'];
        $group_model = \app\models\ClassGroup::findOne($id);
        $program_model = \app\models\Program::findOne($group_model->program_id);
        $query = Section::find()->where(['program_id' => $program_model->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);
        return $this->render('student-program', ['data' => $dataProvider]);
    }



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSection()
    {
        return $this->render('section');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionStudentSection()
    {
        return $this->render('student-section');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTasks()
    {
        $sec_id = $_GET['section_id'];
        $query = Task::find()->where(['section_id' => $sec_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('tasks', ['data' => $dataProvider]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionStudentTasks()
    {
        $sec_id = $_GET['section_id'];
        $query = Task::find()->where(['section_id' => $sec_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('student-tasks', ['data' => $dataProvider]);
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionTask()
    {
        return $this->render('task');
    }




//    public function sendMessage(){
////        $class_id = $_GET['class_id'];
//        return 0;
//    }

//    public function loginToSys()
//    {
//        if((Yii::$app->user->can('student'))or(Yii::$app->user->can('teacher'))or(Yii::$app->user->can('parent'))){
//            return $this->redirect(["site/index"]);
//        }elseif(Yii::$app->user->can('student')){
//            return $this->redirect(["site/waiting"]);
//        }elseif ((Yii::$app->user->can('admin'))or(Yii::$app->user->can('moder'))){
//            return $this->redirect(["site/admin"]);
//        }
//    }


    /**
     * @throws Exception
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {

                    $userRole = Yii::$app->authManager->getRole('user');
                    Yii::$app->authManager->assign($userRole, \Yii::$app->user->id);

                    return $this->redirect(["site/waiting"]);
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();

        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->can('teacher')){
                return $this->redirect(["site/teacher-profile"]);
            }elseif(Yii::$app->user->can('student')){
                return $this->redirect(["site/student-groups"]);
            }elseif(Yii::$app->user->can('parent')){
                return $this->redirect(["site/index"]);
            }elseif(Yii::$app->user->can('user')){
                return $this->redirect(["site/waiting"]);
            }elseif ((Yii::$app->user->can('admin'))or(Yii::$app->user->can('moder'))){
                return $this->redirect(["site/admin"]);
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionAdmin()
    {
        return $this->render('admin');
    }

    public function actionWaiting()
    {
        return $this->render('waiting');
    }



    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRole()
    {
//        $admin = Yii::$app -> AuthManager -> createRole('admin');
//        $admin -> description = 'Администратор';
//        Yii::$app -> AuthManager -> add($admin);
//        $moder = Yii::$app -> AuthManager -> createRole('moder');
//        $moder -> description = 'Модератор';
//        Yii::$app -> AuthManager -> add($moder);
//
//        $student = Yii::$app -> AuthManager -> createRole('student');
//        $student -> description = 'Ученик';
//        Yii::$app -> AuthManager -> add($student);
//
//        $teacher = Yii::$app -> AuthManager -> createRole('teacher');
//        $teacher -> description = 'Учитель';
//        Yii::$app -> AuthManager -> add($teacher);
//
//        $parent = Yii::$app -> AuthManager -> createRole('parent');
//        $parent -> description = 'Родитель';
//        Yii::$app -> AuthManager -> add($parent);
//
//        $user = Yii::$app -> AuthManager -> createRole('user');
//        $user -> description = 'Пользователь';
//        Yii::$app -> AuthManager -> add($user);
//
//        $ban = Yii::$app -> AuthManager -> createRole('banned');
//        $ban -> description = 'Заблокированный пользователь';
//        Yii::$app -> AuthManager -> add($ban);
//
//        $permit = Yii::$app->authManager->createPermission('adminPanel');
//        $permit->description = 'Право входа в админ-панель';
//        Yii::$app->authManager->add($permit);
//
//        $role_a = Yii::$app->authManager->getRole('admin');
//        $role_m = Yii::$app->authManager->getRole('moder');
//        $permit = Yii::$app->authManager->getPermission('adminPanel');
//        Yii::$app->authManager->addChild($role_m, $permit);
//
//        $permit = Yii::$app->authManager->createPermission('changeUserRoles');
//        $permit->description = 'Право менять роли пользователей';
//        Yii::$app->authManager->add($permit);

//        $role_a = Yii::$app->authManager->getRole('admin');
//        $permit = Yii::$app->authManager->getPermission('changeUserRoles');
//        Yii::$app->authManager->addChild($role_a, $permit);

//        $permit = Yii::$app->authManager->createPermission('addStudentsToClass');
//        $permit->description = 'Право добавлять учеников в класс';
//        Yii::$app->authManager->add($permit);
//
//        $role_a = Yii::$app->authManager->getRole('admin');
//        $role_t = Yii::$app->authManager->getRole('teacher');
//
//        $permit = Yii::$app->authManager->getPermission('addStudentsToClass');
//        Yii::$app->authManager->addChild($role_a, $permit);
//        Yii::$app->authManager->addChild($role_t, $permit);
//
//        $permit = Yii::$app->authManager->createPermission('createClass');
//        $permit->description = 'Право создавать класс';
//        Yii::$app->authManager->add($permit);

//        $role_a = Yii::$app->authManager->getRole('admin');
//        $role_t = Yii::$app->authManager->getRole('teacher');
//
//        $permit = Yii::$app->authManager->getPermission('createClass');
//        Yii::$app->authManager->addChild($role_a, $permit);
//        Yii::$app->authManager->addChild($role_t, $permit);
//
//
//        $userRole = Yii::$app->authManager->getRole('moder');
//        Yii::$app->authManager->assign($userRole, 2);
        return 123;
    }


}
