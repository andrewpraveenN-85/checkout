<?php

namespace backend\controllers\settings\configurations;

use Yii;
use backend\models\Taxes;
use backend\models\TaxesSearch;
use yii\web\Controller;

class TaxController extends Controller {

    public function actionIndex($id = null) {
        $model = $id ? $this->findModel($id) : new Taxes();
        $searchModel = new TaxesSearch(['company_id' => Yii::$app->user->identity->company_id]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    public function actionCreate() {
        $model = new Taxes();
        $model->company_id = Yii::$app->user->identity->company_id;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tax created successfully.');
            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tax updated successfully.');
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = Taxes::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Taxes();
        }
    }
}
