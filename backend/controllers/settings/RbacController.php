<?php

namespace backend\controllers\settings;

use Yii;
use backend\models\Roles;
use backend\models\RolesSearch;
use backend\models\PermissionSearch;
use backend\models\RolesPermissions;
use yii\web\Controller;

/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RbacController extends Controller {

    public function actionIndex($id = null) {
        $model = $id ? $this->findModel($id) : new Roles();
        $model->permissionList = $id ? implode(',', RolesPermissions::find()->select('permission_id')->where(['role_id' => $id])->column()) : implode(',', []);

        $searchModel = new RolesSearch(['company_id' => Yii::$app->user->identity->company_id]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        $searchModelPermission = new PermissionSearch(['status' => 'active']);
        $dataProviderPermission = $searchModelPermission->search($this->request->queryParams);
        $dataProviderPermission->query->andWhere(['!=', 'name', '*']);
        $dataProviderPermission->query->andWhere(['!=', 'name', '/']);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'searchModelPermission' => $searchModelPermission,
                    'dataProviderPermission' => $dataProviderPermission,
        ]);
    }

    public function actionCreate() {
        $model = new Roles();
        $model->company_id = Yii::$app->user->identity->company_id;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            foreach (explode(',', $model->permissionList) as $permission) {
                $rolePermission = new RolesPermissions(['role_id' => $model->id, 'permission_id' => $permission]);
                $rolePermission->save();
            }
            Yii::$app->session->setFlash('success', 'Role and permission created.');
            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            RolesPermissions::deleteAll(['role_id' => $id]);
            foreach (explode(',', $model->permissionList) as $permission) {
                $rolePermission = new RolesPermissions(['role_id' => $model->id, 'permission_id' => $permission]);
                $rolePermission->save();
            }
            Yii::$app->session->setFlash('success', 'Role and permission updated.');
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = Roles::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Roles();
        }
    }
}
