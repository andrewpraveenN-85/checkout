<?php

namespace backend\controllers;

use backend\models\SalesProducts;
use backend\models\SalesProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesProductsController implements the CRUD actions for SalesProducts model.
 */
class SalesProductsController extends Controller
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
     * Lists all SalesProducts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SalesProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesProducts model.
     * @param string $sales_id Sales ID
     * @param string $product_variation_id Product Variation ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sales_id, $product_variation_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sales_id, $product_variation_id),
        ]);
    }

    /**
     * Creates a new SalesProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SalesProducts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sales_id' => $model->sales_id, 'product_variation_id' => $model->product_variation_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SalesProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $sales_id Sales ID
     * @param string $product_variation_id Product Variation ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sales_id, $product_variation_id)
    {
        $model = $this->findModel($sales_id, $product_variation_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sales_id' => $model->sales_id, 'product_variation_id' => $model->product_variation_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SalesProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $sales_id Sales ID
     * @param string $product_variation_id Product Variation ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sales_id, $product_variation_id)
    {
        $this->findModel($sales_id, $product_variation_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SalesProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $sales_id Sales ID
     * @param string $product_variation_id Product Variation ID
     * @return SalesProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sales_id, $product_variation_id)
    {
        if (($model = SalesProducts::findOne(['sales_id' => $sales_id, 'product_variation_id' => $product_variation_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
