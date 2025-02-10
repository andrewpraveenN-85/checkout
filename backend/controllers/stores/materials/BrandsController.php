<?php

namespace backend\controllers\stores\materials;

use Yii;
use backend\models\RawItemsBrands;
use backend\models\RawItemsBrandsSearch;
use yii\web\Controller;

class BrandsController extends Controller {

    public function actionIndex($id = null) {
        $model = $id ? $this->findModel($id) : new RawItemsBrands();
        $searchModel = new RawItemsBrandsSearch(['company_id' => Yii::$app->user->identity->company_id]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    public function actionCreate() {
        $model = new RawItemsBrands();
        $model->company_id = Yii::$app->user->identity->company_id;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Brand Created.');
            return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Brand updated.');
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = RawItemsBrands::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new RawItemsBrands();
        }
    }
}
