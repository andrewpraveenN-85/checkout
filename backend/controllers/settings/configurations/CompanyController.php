<?php

namespace backend\controllers\settings\configurations;

use backend\models\Companies;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use Yii;

/**
 * CompanyController handles company-related actions, including profile updates and logo uploads.
 */
class CompanyController extends Controller
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
     * Lists the company details for the logged-in user.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = $this->findModel(Yii::$app->user->identity->company_id);


        $states = $this->fetchStates($model->country);
        $cities = $this->fetchCities($model->country);
        asort($states);
        asort($cities);

        return $this->render('index', [
            'model' => $model,
            'countries' => $this->getCountries(),
            'states' => $this->getDropDownArray($states),
            'cities' => $this->getDropDownArray($cities),
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model via AJAX request.
     * If update is successful, the browser remains on the index page.
     *
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
        {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $companyId = Yii::$app->user->identity->company_id;
            $model = $this->findModel($companyId);

            if ($this->request->isPost) {
                if ($model->load(Yii::$app->request->post())) {

                    // Handle file upload
                    $logoFile = UploadedFile::getInstance($model, 'logo');
                    if ($logoFile) {
                        $companyDir = Yii::getAlias('@webroot/uploads/company_logos/' . $model->id);
                        if (!is_dir($companyDir)) {
                            mkdir($companyDir, 0777, true);
                        }
                        $logoPath = $companyDir . '/' . $model->id . '.' . $logoFile->extension;
                        if ($logoFile->saveAs($logoPath)) {
                            $model->logo = '/uploads/company_logos/' . $model->id . '.' . $logoFile->extension;
                        }
                    }

                    if ($model->validate() && $model->save()) { // 🔹 Fix: Validate before saving
                        return ['success' => true, 'message' => 'Company details updated successfully.'];
                    } else {
                        return ['success' => false, 'errors' => $model->errors];
                    }
                }
            }

            return ['success' => false, 'message' => 'Invalid request.'];
        }


    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id ID
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested company does not exist.');
    }


    private function fetchStates($country) {
        $data = $this->getCountriesNowAPI('https://countriesnow.space/api/v0.1/countries/states');
        foreach ($data as $item) {
            if ($item['iso2'] === $country) {
                return array_column($item['states'], 'name');
            }
        }
        return [];
    }

    private function fetchCities($country) {
        $data = $this->getCountriesNowAPI('https://countriesnow.space/api/v0.1/countries');
        foreach ($data as $item) {
            if ($item['iso2'] === $country) {
                return $item['cities'];
            }
        }
        return [];
    }

    public function actionGetStatesCities($country) {
        $states = $this->fetchStates($country);
        $cities = $this->fetchCities($country);
        asort($states);
        asort($cities);
        return json_encode([
            'states' => $this->getDropDownOptions($states),
            'cities' => $this->getDropDownOptions($cities)
        ]);
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

    private function getDropDownArray($array) {
        $options = [];
        foreach ($array as $value) {
            $options[htmlspecialchars($value)] = htmlspecialchars($value);
        }
        return $options;
    }

    private function getDropDownOptions($array) {
        $options = "<option value=''>Select...</option>";
        foreach ($array as $value) {
            $options .= "<option value='" . htmlspecialchars($value) . "'>" . htmlspecialchars($value) . "</option>";
        }
        return $options;
    }


    public function actionProfilePicture() {
        $model = $this->findModel(Yii::$app->user->identity->company_id);
    
        // Ensure the company exists
        if (!$model) {
            Yii::$app->session->setFlash('error', 'Company not found.');
            return $this->redirect(['index']);
        }
    
        // Define the directory path for uploads
        $companyDir = Yii::getAlias('@webroot/storage/' . $model->id . '/');
    
        // Create directory if it does not exist
        if (!is_dir($companyDir)) {
            mkdir($companyDir, 0777, true);
        }
    
        if (Yii::$app->request->isPost) {
            // Handle Image Removal
            if (Yii::$app->request->post('remove_logo')) {

                if (!empty($model->logo) && file_exists(Yii::getAlias('@webroot/' . $model->logo))) {
                    unlink(Yii::getAlias('@webroot/' . $model->logo)); // Delete file from server
                }

                $model->logo = null; // Remove from database

                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Company Logo Removed.');
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to remove logo.');
                }

                return $this->redirect(['index']);
            }
    
            // Handle Image Upload
            $image = UploadedFile::getInstance($model, 'logo');
    
            if ($image) {
                // Define image name and path
                $imageName = $model->id . "_logo." . $image->getExtension();
                $uploadPath = $companyDir . $imageName;
    
                // Save image to directory
                if ($image->saveAs($uploadPath)) {
                    // Save the new image path in the database
                    $model->logo = 'storage/' . $model->id . '/' . $imageName;
    
                    if ($model->save(false)) {
                        Yii::$app->session->setFlash('success', 'Company Logo Updated.');
                        return $this->redirect(['index']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to upload logo.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'No image selected.');
            }
        }
    
        return $this->redirect(['index']);
    }
    
}
