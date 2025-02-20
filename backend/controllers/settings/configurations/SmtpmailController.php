<?php

namespace backend\controllers\settings\configurations;

use Yii;
use backend\models\SmtpConfigurations;
use backend\models\SmtpConfigurationsSearch;
use yii\web\Controller;

class SmtpmailController extends Controller {

    public function actionIndex($id = null) {
        $model = $id ? $this->findModel($id) : new SmtpConfigurations();
        $searchModel = new SmtpConfigurationsSearch(['company_id' => Yii::$app->user->identity->company_id]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    public function actionCreate() {
        $model = new SmtpConfigurations();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = SmtpConfigurations::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new SmtpConfigurations();
        }
    }
}
