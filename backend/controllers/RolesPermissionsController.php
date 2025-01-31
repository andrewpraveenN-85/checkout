<?php

namespace backend\controllers;

use backend\models\RolesPermissions;
use backend\models\RolesPermissionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RolesPermissionsController implements the CRUD actions for RolesPermissions model.
 */
class RolesPermissionsController extends Controller
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
     * Lists all RolesPermissions models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RolesPermissionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RolesPermissions model.
     * @param string $role_id Role ID
     * @param string $permission_id Permission ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($role_id, $permission_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($role_id, $permission_id),
        ]);
    }

    /**
     * Creates a new RolesPermissions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RolesPermissions();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'role_id' => $model->role_id, 'permission_id' => $model->permission_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RolesPermissions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $role_id Role ID
     * @param string $permission_id Permission ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($role_id, $permission_id)
    {
        $model = $this->findModel($role_id, $permission_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'role_id' => $model->role_id, 'permission_id' => $model->permission_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RolesPermissions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $role_id Role ID
     * @param string $permission_id Permission ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($role_id, $permission_id)
    {
        $this->findModel($role_id, $permission_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RolesPermissions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $role_id Role ID
     * @param string $permission_id Permission ID
     * @return RolesPermissions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($role_id, $permission_id)
    {
        if (($model = RolesPermissions::findOne(['role_id' => $role_id, 'permission_id' => $permission_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
