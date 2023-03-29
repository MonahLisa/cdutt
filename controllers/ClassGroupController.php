<?php

namespace app\controllers;

use app\models\Chat;
use app\models\ClassGroup;
use app\models\ClassGroupSearch;
use app\models\ParentGroup;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ClassGroupController implements the CRUD actions for ClassGroup model.
 */
class ClassGroupController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ClassGroup models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClassGroupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single ClassGroup model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClassGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        function loging($text, $varr) {
            echo '<hr>';
            echo $text . '<br><br>';
            var_dump($varr);
            echo '<hr>';
        }
        $model = new ClassGroup();
        $user_model = Yii::$app->user;

        if ($this->request->isPost) {
            loging('$this->request->isPost', $this->request->post());
            if ($model->load($this->request->post())) {
                $dir = Yii::getAlias('@web').'/uploads/images/classes/';

                $model->photo = UploadedFile::getInstance($model, 'photo');
                loging('$model->photo', $model->photo);
                $newFile = md5($model->photo->baseName . '.' . $model->photo->extension . time()). '_group_' . $model->number . '.' . $model->photo->extension;
                loging('$newFile', $newFile);

                loging('$model->document->saveAs',$model->photo->saveAs('@app/web/uploads/images/classes/'. $newFile));
                $model->photo = $newFile;
                loging('$model->photo', $model->photo);
                $model->created_by =  $user_model->id;
                $model->save();
                $parent_model = new ParentGroup();
                $parent_model->photo = $model->photo;
                $parent_model->title = 'Родительский чат группы '.$model->number;
                $parent_model->descriptor = $model->descriptor;
                $parent_model->created_by = $model->created_by;
                $parent_model->class_id=$model->id;
                $parent_model->save();

                $chat_model = new Chat();
                $chat_model->class_id = $model->id;
                $chat_model->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Updates an existing ClassGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ClassGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClassGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ClassGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClassGroup::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
