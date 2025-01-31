<?php

namespace backend\controllers;

use backend\models\StoreFactoryReleaseRawItems;
use backend\models\StoreFactoryReleaseRawItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreFactoryReleaseRawItemsController implements the CRUD actions for StoreFactoryReleaseRawItems model.
 */
class StoreFactoryReleaseRawItemsController extends Controller
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
     * Lists all StoreFactoryReleaseRawItems models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StoreFactoryReleaseRawItemsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreFactoryReleaseRawItems model.
     * @param string $stock_transfer_id Stock Transfer ID
     * @param string $raw_items_id Raw Items ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($stock_transfer_id, $raw_items_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($stock_transfer_id, $raw_items_id),
        ]);
    }

    /**
     * Creates a new StoreFactoryReleaseRawItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new StoreFactoryReleaseRawItems();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'stock_transfer_id' => $model->stock_transfer_id, 'raw_items_id' => $model->raw_items_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreFactoryReleaseRawItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $stock_transfer_id Stock Transfer ID
     * @param string $raw_items_id Raw Items ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($stock_transfer_id, $raw_items_id)
    {
        $model = $this->findModel($stock_transfer_id, $raw_items_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'stock_transfer_id' => $model->stock_transfer_id, 'raw_items_id' => $model->raw_items_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StoreFactoryReleaseRawItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $stock_transfer_id Stock Transfer ID
     * @param string $raw_items_id Raw Items ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($stock_transfer_id, $raw_items_id)
    {
        $this->findModel($stock_transfer_id, $raw_items_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreFactoryReleaseRawItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $stock_transfer_id Stock Transfer ID
     * @param string $raw_items_id Raw Items ID
     * @return StoreFactoryReleaseRawItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($stock_transfer_id, $raw_items_id)
    {
        if (($model = StoreFactoryReleaseRawItems::findOne(['stock_transfer_id' => $stock_transfer_id, 'raw_items_id' => $raw_items_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
