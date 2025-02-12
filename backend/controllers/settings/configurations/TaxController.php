<?php

namespace backend\controllers\settings\configurations;

use Yii;
use backend\models\Taxes;
use backend\models\TaxesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

class TaxController extends Controller {

    /**
     * Lists all Taxes models.
     *
     * @return string
     */
    public function actionIndex($id = null)
    {
        $model = $id ? $this->findModel($id) : new Taxes();

        $searchModel = new TaxesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionCreate() {
        $model = new Taxes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->company_id = 1; // Replace with the actual company ID
                if ($model->save()) {
                    // Insert into configurations table
                    $configuration = new \backend\models\Configurations();
                    $configuration->company_id = $model->company_id;
                    $configuration->default_tax_id = $model->id;
                    $configuration->created_at = date('Y-m-d H:i:s');
                    $configuration->updated_at = date('Y-m-d H:i:s');
                    if ($configuration->save()) {
                        Yii::$app->session->setFlash('success', 'Tax Created.');
                        return $this->redirect(['index']);
                    } else {
                        // Handle error if configuration save fails
                        Yii::$app->session->setFlash('error', 'Failed to save configuration.');
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Taxes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tax Updated.');
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
