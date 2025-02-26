<?php

namespace backend\controllers\settings;
use Yii;
use backend\models\Configurations;
use yii\web\Controller;
use backend\models\Currencies;
use backend\models\Languages;
use yii\helpers\ArrayHelper;

class ConfigurationController extends Controller {

    public function actionIndex() {
        $currencies = ArrayHelper::map(Currencies::find()->andWhere(['status' => 'active'])->all(), 'id', 'name');
        $languages = ArrayHelper::map(Languages::find()->andWhere(['status' => 'active'])->all(), 'id', 'name');
        $timezones=[];
        foreach (timezone_identifiers_list() as $value) {
            $timezones[$value] = $value;
        }
        return $this->render('index', [
            'model' => $this->findModel(Yii::$app->user->identity->company_id),
            'currencies' => $currencies,
            'languages' => $languages,
            'timezones' => $timezones,
        ]);
    }

    public function actionUpdate() {
        $model = $this->findModel(Yii::$app->user->identity->company_id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Configurations updated successfully.');
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = Configurations::findOne(['company_id' => $id])) !== null) {
            return $model;
        }else{
            return new Configurations();
        }
    }
}
