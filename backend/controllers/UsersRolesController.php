<?php

namespace backend\controllers;

use backend\models\UsersRoles;
use backend\models\UsersRolesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersRolesController implements the CRUD actions for UsersRoles model.
 */
class UsersRolesController extends Controller
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
     * Lists all UsersRoles models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsersRolesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsersRoles model.
     * @param string $user_id User ID
     * @param string $role_id Role ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $role_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $role_id),
        ]);
    }

    /**
     * Creates a new UsersRoles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UsersRoles();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'user_id' => $model->user_id, 'role_id' => $model->role_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UsersRoles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $user_id User ID
     * @param string $role_id Role ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $role_id)
    {
        $model = $this->findModel($user_id, $role_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'role_id' => $model->role_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UsersRoles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $user_id User ID
     * @param string $role_id Role ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $role_id)
    {
        $this->findModel($user_id, $role_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsersRoles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $user_id User ID
     * @param string $role_id Role ID
     * @return UsersRoles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $role_id)
    {
        if (($model = UsersRoles::findOne(['user_id' => $user_id, 'role_id' => $role_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
