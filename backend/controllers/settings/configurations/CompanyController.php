<?php

namespace backend\controllers\settings\configurations;

use backend\models\Companies;
use yii\web\Controller;
use backend\models\Cities;
use backend\models\States;
use backend\models\Countries;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use Yii;

/**
 * CompanyController handles company-related actions, including profile updates and logo uploads.
 */
class CompanyController extends Controller {

    public function actionIndex() {
        $model = $this->findModel(Yii::$app->user->identity->company_id);
        $model->state = $model->city->state_id;
        $model->country = $model->city->state->country_id;
        $countries = ArrayHelper::map(Countries::find()->andWhere(['status' => 'active'])->all(), 'id', 'name');
        $states = ArrayHelper::map(States::find()->andWhere(['status' => 'active', 'country_id' => $model->city->state->country_id])->all(), 'id', 'name');
        $cities = ArrayHelper::map(Cities::find()->andWhere(['status' => 'active', 'state_id' => $model->city->state_id])->all(), 'id', 'name');
        return $this->render('index', [
                    'model' => $model,
                    'countries' => $countries,
                    'states' => $states,
                    'cities' => $cities,
        ]);
    }

    public function actionUpdate() {
        $model = $this->findModel(Yii::$app->user->identity->company_id);
        if ($this->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Profile updated successfully.');
            return $this->redirect(['index']);
        }
    }
    
    public function actionCompanyLogo() {
        $model = $this->findModel(Yii::$app->user->identity->company_id);
        if (!is_dir(Yii::getAlias('@webroot/storage/' . $model->id))) {
            mkdir(Yii::getAlias('@webroot/storage/' . $model->id), 0777, true);
        }
        if (Yii::$app->request->isPost) {
            if (Yii::$app->request->post('remove_picture') && !empty($model->logo) && file_exists(Yii::getAlias('@webroot/storage/' . $model->id . '/' . $model->logo))) {
                unlink(Yii::getAlias('@webroot/storage/' . $model->id . '/' . $model->logo));
                $model->logo = null;
            } else {
                $image = UploadedFile::getInstance($model, 'picture');
                if (!empty($image)) {
                    $uploadPath = Yii::getAlias('@webroot/storage/' . $model->id . '/') . $model->id . '.' . $image->getExtension();
                    if ($image->saveAs($uploadPath)) {
                        $model->logo = $model->id . '.' . $image->getExtension();
                    }
                }
            }
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Company logo updated successfully.');
                return $this->redirect(['index']);
            }
        }
    }

    protected function findModel($id) {
        if (($model = Companies::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Companies();
        }
    }

    public function actionGetStates($country) {
        $states = ArrayHelper::map(States::find()->andWhere(['status' => 'active', 'country_id' => $country])->all(), 'id', 'name');
        $options = "<option value=''>State...</option>";
        foreach ($states as $value => $key) {
            $options .= "<option value='" . $value . "'>" . htmlspecialchars($key) . "</option>";
        }
        return json_encode($options);
    }

    public function actionGetCities($states) {
        $cities = ArrayHelper::map(Cities::find()->andWhere(['status' => 'active', 'state_id' => $states])->all(), 'id', 'name');
        $options = "<option value=''>City...</option>";
        foreach ($cities as $value => $key) {
            $options .= "<option value='" . $value . "'>" . htmlspecialchars($key) . "</option>";
        }
        return json_encode($options);
    }
}
