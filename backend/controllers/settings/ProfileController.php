<?php

namespace backend\controllers\settings;

use Yii;
use common\models\Users;
use backend\models\Cities;
use backend\models\States;
use backend\models\Countries;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

class ProfileController extends Controller {

    public function actionIndex() {
        $model = $this->findModel(Yii::$app->user->id);
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

    public function actionProfile() {
        $model = $this->findModel(Yii::$app->user->id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Profile updated successfully.');
            return $this->redirect(['index']);
        }
    }

    public function actionProfilePicture() {
        $model = $this->findModel(Yii::$app->user->id);
        if (!is_dir(Yii::getAlias('@webroot/storage/' . $model->company_id))) {
            mkdir(Yii::getAlias('@webroot/storage/' . $model->company_id), 0777, true);
        }
        if (!is_dir(Yii::getAlias('@webroot/storage/' . $model->company_id . '/profile_picture'))) {
            mkdir(Yii::getAlias('@webroot/storage/' . $model->company_id . '/profile_picture'), 0777, true);
        }
        if (Yii::$app->request->isPost) {
            if (Yii::$app->request->post('remove_picture') && !empty($model->profile_picture) && file_exists(Yii::getAlias('@webroot/storage/' . $model->company_id . '/profile_picture/' . $model->profile_picture))) {
                unlink(Yii::getAlias('@webroot/storage/' . $model->company_id . '/profile_picture/' . $model->profile_picture));
                $model->profile_picture = null;
            } else {
                $image = UploadedFile::getInstance($model, 'picture');
                if (!empty($image)) {
                    $uploadPath = Yii::getAlias('@webroot/storage/' . $model->company_id . '/profile_picture/') . $model->id . '.' . $image->getExtension();
                    if ($image->saveAs($uploadPath)) {
                        $model->profile_picture = $model->id . '.' . $image->getExtension();
                    }
                }
            }
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Profile picture updated successfully.');
                return $this->redirect(['index']);
            }
        }
    }

    public function actionPassword() {
        $model = $this->findModel(Yii::$app->user->id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->validatePassword($model->password)) {
                $model->setPassword($model->newpassword);
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Profile password updated successfully.');
                    return $this->redirect(['index']);
                }
            }
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

    protected function findModel($id) {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Users();
        }
    }
}
