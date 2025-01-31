<?php

namespace backend\controllers;

use backend\models\StoreSellingpointReleaseProducts;
use backend\models\StoreSellingpointReleaseProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreSellingpointReleaseProductsController implements the CRUD actions for StoreSellingpointReleaseProducts model.
 */
class StoreSellingpointReleaseProductsController extends Controller
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
     * Lists all StoreSellingpointReleaseProducts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StoreSellingpointReleaseProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreSellingpointReleaseProducts model.
     * @param string $store_selling_point_id Store Selling Point ID
     * @param string $product_variation_id Product Variation ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($store_selling_point_id, $product_variation_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($store_selling_point_id, $product_variation_id),
        ]);
    }

    /**
     * Creates a new StoreSellingpointReleaseProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new StoreSellingpointReleaseProducts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'store_selling_point_id' => $model->store_selling_point_id, 'product_variation_id' => $model->product_variation_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreSellingpointReleaseProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $store_selling_point_id Store Selling Point ID
     * @param string $product_variation_id Product Variation ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($store_selling_point_id, $product_variation_id)
    {
        $model = $this->findModel($store_selling_point_id, $product_variation_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'store_selling_point_id' => $model->store_selling_point_id, 'product_variation_id' => $model->product_variation_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreSellingpointReleaseProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $store_selling_point_id Store Selling Point ID
     * @param string $product_variation_id Product Variation ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($store_selling_point_id, $product_variation_id)
    {
        $this->findModel($store_selling_point_id, $product_variation_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreSellingpointReleaseProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $store_selling_point_id Store Selling Point ID
     * @param string $product_variation_id Product Variation ID
     * @return StoreSellingpointReleaseProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($store_selling_point_id, $product_variation_id)
    {
        if (($model = StoreSellingpointReleaseProducts::findOne(['store_selling_point_id' => $store_selling_point_id, 'product_variation_id' => $product_variation_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
