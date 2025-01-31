<?php

namespace backend\controllers\settings;
use Yii;
use backend\models\Users;
use yii\web\Controller;

class ProfileController extends Controller {

    public function behaviors() {
        return array_merge(
                
        );
    }

    public function actionIndex() {
        $model = $this->findModel(Yii::$app->user->id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    protected function findModel($id) {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Users();
        }
    }
}
