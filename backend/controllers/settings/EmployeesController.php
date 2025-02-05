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
class EmployeesController extends Controller
{
    public function actionIndex($id = null)
    {
        $model = $id ? $this->findModel($id) : new Users();

        $roles = ArrayHelper::map(
            Roles::find()
                ->where([
                    'status' => 'active',
                    'company_id' => Yii::$app->user->identity->company_id
                ])
                ->all(),
            'id',
            'name'
        );

        $searchModel = new UsersSearch([
            'company_id' => Yii::$app->user->identity->company_id,
            'user_type' => 'employee'
        ]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'roles' => $roles,
            'countries' => $this->getCountries(),
        ]);
    }

    public function actionCreate()
    {
        $model = new Users();
        $model->company_id = Yii::$app->user->identity->company_id;
        $model->generateAuthKey();
        $model->user_type = 'employee';
        $model->status = 'active';

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->setPassword($model->password);

            // Set role_id from the posted data

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Employee Created.');
                return $this->redirect(['index']);
            }
        }

        // Get roles for dropdown
        $roles = ArrayHelper::map(
            Roles::find()
                ->where([
                    'status' => 'active',
                    'company_id' => Yii::$app->user->identity->company_id
                ])
                ->all(),
            'id',
            'name'
        );

        return $this->render('index', [
            'model' => $model,
            'roles' => $roles,
            'countries' => $this->getCountries(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            // Debug posted data
            Yii::debug('Update data: ' . print_r($this->request->post(), true));

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Employee Updated Successfully.');
                return $this->redirect(['index']);
            } else {
                Yii::debug('Update errors: ' . print_r($model->errors, true));
                Yii::$app->session->setFlash('error', 'Failed to update employee.');
            }
        }

        // Get roles for dropdown
        $roles = ArrayHelper::map(
            Roles::find()
                ->where([
                    'status' => 'active',
                    'company_id' => Yii::$app->user->identity->company_id
                ])
                ->all(),
            'id',
            'name'
        );

        return $this->render('index', [
            'model' => $model,
            'roles' => $roles,
            'countries' => $this->getCountries(),
            'searchModel' => new UsersSearch([
                'company_id' => Yii::$app->user->identity->company_id,
                'user_type' => 'employee'
            ]),
            'dataProvider' => (new UsersSearch([
                'company_id' => Yii::$app->user->identity->company_id,
                'user_type' => 'employee'
            ]))->search($this->request->queryParams),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Users();
        }
    }

    private function getCountries()
    {
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

    private function getCountriesNowAPI($url)
    {
        $contents = file_get_contents($url);
        return json_decode($contents, true)['data'];
    }
}
