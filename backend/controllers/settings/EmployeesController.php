<?php

namespace backend\controllers\settings;

use Yii;
use common\models\Users;
use backend\models\UsersSearch;
use yii\web\Controller;
use backend\models\Roles;
use yii\helpers\ArrayHelper;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class EmployeesController extends Controller {

    public function actionIndex($id = null) {
        $model = $id ? $this->findModel($id) : new Users();
        $roles = ArrayHelper::map(Roles::find()->andWhere(['status' => 'active', 'company_id' => Yii::$app->user->identity->company_id])->all(), 'id', 'name');
        $searchModel = new UsersSearch(['company_id' => Yii::$app->user->identity->company_id, 'user_type' => 'employee']);
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'countries' => $this->getCountries(),
                    'roles' => $roles,
                    'countries' => $this->getCountries(),
        ]);
    }

    public function actionCreate() {
        $model = new Users();
        $model->company_id = Yii::$app->user->identity->company_id;
        $model->generateAuthKey();
        $user->user_type = 'employee';
        $user->status = 'active';
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->setPassword($model->password);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Employee Created.');
                return $this->redirect(['index']);
            }
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Users();
        }
    }

    private function getCountries() {
        $countries = $this->getCountriesNowAPI('https://countriesnow.space/api/v0.1/countries/positions');

        $countryList = [];
        if (!empty($countries)) {
            foreach ($countries as $country) {
                $countryList[$country['iso2']] = $country['name'];
            }
        }
        asort($countryList);
        return $countryList;
    }

    private function getCountriesNowAPI($url) {
        $contents = file_get_contents($url);
        return json_decode($contents, true)['data'];
    }
}
