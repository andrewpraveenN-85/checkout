<?php

namespace backend\controllers\stores\materials;	

use backend\models\MeasurementUnits;
use backend\models\MeasurementUnitsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * MeasurementUnitsController implements the CRUD actions for MeasurementUnits model.
 */
class MeasurementUnitsController extends Controller
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
     * Lists all MeasurementUnits models.
     *
     * @return string
     */
    // public function actionIndex()
    // {
    //     $searchModel = new MeasurementUnitsSearch();
    //     $dataProvider = $searchModel->search($this->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }



    public function actionIndex($id = null) {
        $model = $id ? $this->findModel($id) : new MeasurementUnits();
        $searchModel = new MeasurementUnitsSearch(['company_id' => Yii::$app->user->identity->company_id]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single MeasurementUnits model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MeasurementUnits model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new MeasurementUnits();
    //     $model->company_id = Yii::$app->user->identity->company_id;
    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {

    //             Yii::$app->session->setFlash('success', 'Measurement Unit Created.');
    //             return $this->redirect(['view', 'id' => $model->id]);

    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }



 
 

    public function actionCreate() {
        $model = new MeasurementUnits();
        $model->company_id = Yii::$app->user->identity->company_id;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Measurement Unit Created.');
            return $this->redirect(['index']);
        }
    }













    /**
     * Updates an existing MeasurementUnits model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         Yii::$app->session->setFlash('success', 'Measurement Unit Updated.');
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }



    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Measurement Unit updated.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing MeasurementUnits model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Measurement Unit Deleted.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the MeasurementUnits model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return MeasurementUnits the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MeasurementUnits::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
