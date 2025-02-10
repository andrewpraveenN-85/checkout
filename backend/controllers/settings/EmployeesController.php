<?php

namespace backend\controllers\settings;

use Yii;
use common\models\Users;
use backend\models\UsersSearch;
use yii\web\Controller;
use backend\models\Roles;
use yii\helpers\ArrayHelper;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class EmployeesController extends Controller {

    public function actionIndex($id = null) {
        $model = $id ? $this->findModel($id) : new Users();

        $roles = ArrayHelper::map(
                Roles::find()
                        ->where([
                            'status' => 'active',
                            'company_id' => Yii::$app->user->identity->company_id
                        ])
                        ->all(),
                'id',
                'name'
        );

        $searchModel = new UsersSearch([
            'company_id' => Yii::$app->user->identity->company_id,
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'roles' => $roles,
        ]);
    }

    public function actionCreate() {
        $model = new Users();
        $model->company_id = Yii::$app->user->identity->company_id;
        $model->generateAuthKey();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->setPassword($model->password);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Employee Created Successfully.');
                return $this->redirect(['index']);
            }
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Employee Updated Successfully.');
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Users();
        }
    }
}
