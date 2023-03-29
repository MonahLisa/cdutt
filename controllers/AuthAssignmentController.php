<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\AuthAssignmentSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * AuthAssignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthAssignmentController extends Controller
{
//    /**
//     * @inheritDoc
//     */
//    public function behaviors()
//    {
////        return array_merge(
////            parent::behaviors(),
//            return [
//                'access' => [
//                    'class' => AccessControl::class,
//                    'rules' => [
//                        [
//                            'matchCallback' => function () {
////                                var_dump(Yii::$app->user->can('changeUserRoles'));
//                                // Метод вернет true или false в зависимости от роли пользователя.
//                                return Yii::$app->user->can('changeUserRoles');
//                            },
//                        ],
//                    ],
////                    'actions' => [
////                        'delete' => ['POST'],
////                    ],
//                ],
//            ];
////        );
//    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['index', 'create', 'update'],
                'rules' => [

                    [
                        'allow'         => true, // Разрешаем доступ.
                        'actions'       => ['index'], // К действию auth-assignment/index
                        'roles'         => ['@'], // Только аутентифицированному пользователю.
//                        'ips'           => ['127.0.0.1'], // С IP-адресом "127.0.0.1".
                        'verbs'         => ['GET', 'POST', 'PUT'], // Через HTTP методы GET, POST и PUT.
                        'matchCallback' => function () {
                            // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                            return Yii::$app->user->can('changeUserRoles');
//                            return Yii::$app->user->identity->role == User::ROLE_ADMIN;
                        },
                        'denyCallback'  => function () {
                            // Если пользователь не подпадает под все условия, то завершаем работы и выдаем своё сообщение.
                            die('Эта страница доступна только администратору!');
                        },
                    ],
                    [
                        'allow'         => true, // Разрешаем доступ.
                        'actions'       => ['create'], // К действию auth-assignment/index
                        'roles'         => ['@'], // Только аутентифицированному пользователю.
//                        'ips'           => ['127.0.0.1'], // С IP-адресом "127.0.0.1".
                        'verbs'         => ['GET', 'POST', 'PUT'], // Через HTTP методы GET, POST и PUT.
                        'matchCallback' => function () {
                            // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                            return Yii::$app->user->can('changeUserRoles');
//                            return Yii::$app->user->identity->role == User::ROLE_ADMIN;
                        },
                        'denyCallback'  => function () {
                            // Если пользователь не подпадает под все условия, то завершаем работы и выдаем своё сообщение.
                            die('Эта страница доступна только администратору!');
                        },
                    ],
                    [
                        'allow'         => true, // Разрешаем доступ.
                        'actions'       => ['update'], // К действию auth-assignment/index
                        'roles'         => ['@'], // Только аутентифицированному пользователю.
//                        'ips'           => ['127.0.0.1'], // С IP-адресом "127.0.0.1".
                        'verbs'         => ['GET', 'POST', 'PUT'], // Через HTTP методы GET, POST и PUT.
                        'matchCallback' => function () {
                            // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                            return Yii::$app->user->can('changeUserRoles');
//                            return Yii::$app->user->identity->role == User::ROLE_ADMIN;
                        },
                        'denyCallback'  => function () {
                            // Если пользователь не подпадает под все условия, то завершаем работы и выдаем своё сообщение.
                            die('Эта страница доступна только администратору!');
                        },
                    ],
                ],
            ],
        ];
    }


    /**
     * Lists all AuthAssignment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new AuthAssignment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            if($model->item_name === 'student'){
//                var_dump(0);
//            }elseif($model->item_name === 'parent'){
//                var_dump(1);
//            }elseif($model->item_name === 'teacher'){
//                var_dump(2);
//            }
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name Item Name
     * @param string $user_id User ID
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
