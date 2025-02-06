<?php

namespace backend\controllers\settings;

use Yii;
use common\models\Users;
use backend\models\Companies;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProfileController extends Controller {

    public function actionIndex() {
        $model = $this->findModel(Yii::$app->user->id);
        $states = $this->fetchStates($model->country);
        $cities = $this->fetchCities($model->country);
        asort($states);
        asort($cities);

        return $this->render('index', [
                    'countries' => $this->getCountries(),
                    'states' => $this->getDropDownArray($states),
                    'cities' => $this->getDropDownArray($cities),
                    'model' => $model,
        ]);
    }

    public function actionProfile() {
        $model = $this->findModel(Yii::$app->user->id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Profile updated.');
            return $this->redirect(['index']);
        }
    }

    // public function actionProfilePicture() {
    //     $model = $this->findModel(Yii::$app->user->id);
    //     $company = Companies::findOne(['id' => $model->company_id]);
    //     $companyDir = Yii::$app->params['uploadPathIMG'] . $company->name;
    //     if ($this->request->isPost && $model->load($this->request->post())) {
    //         $name = $model->id . "_profile_picture";
    //         $image = UploadedFile::getInstance($model, 'picture');
    //         if (!empty($image)) {
    //             $upload = $companyDir . '/' . $name . '.' . $image->getExtension();
    //             $image->saveAs($upload);
    //             $model->profile_picture = 'storage/' . $company->name . '/' . $name . '.' . $image->getExtension();
    //             if ($model->save(false)) {
    //                 Yii::$app->session->setFlash('success', 'Profile picture updated.');
    //                 return $this->redirect(['index']);
    //             }
    //         } else {
    //             return $this->redirect(['index']);
    //         }
    //     }
    // }
    
    public function actionProfilePicture() {
        $model = $this->findModel(Yii::$app->user->id);
        $company = Companies::findOne(['id' => $model->company_id]);
    
        // Ensure the company exists
        if (!$model || !$company) {
            Yii::$app->session->setFlash('error', 'Company not found.');
            return $this->redirect(['index']);
        }
    
        // Define the directory path for uploads
        $companyDir = Yii::getAlias('@webroot/storage/' . $company->name . '/');
    
        // Create directory if it does not exist
        if (!is_dir($companyDir)) {
            mkdir($companyDir, 0777, true);
        }
    
        if (Yii::$app->request->isPost) {
            // Handle Image Removal
            if (Yii::$app->request->post('remove_picture')) {
                if (!empty($model->profile_picture) && file_exists(Yii::getAlias('@webroot/' . $model->profile_picture))) {
                    unlink(Yii::getAlias('@webroot/' . $model->profile_picture)); // Delete file from server
                }
                $model->profile_picture = null; // Remove from database
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Profile picture removed.');
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to remove profile picture.');
                }
                return $this->redirect(['index']);
            }
    
            // Handle Image Upload
            $image = UploadedFile::getInstance($model, 'picture');
    
            if ($image) {
                $imageName = $model->id . "_profile_picture." . $image->getExtension();
                $uploadPath = $companyDir . $imageName;
    
                // Save image to directory
                if ($image->saveAs($uploadPath)) {
                    // Save the new image path in the database
                    $model->profile_picture = 'storage/' . $company->name . '/' . $imageName;
    
                    if ($model->save(false)) {
                        Yii::$app->session->setFlash('success', 'Profile picture updated.');
                        return $this->redirect(['index']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to upload profile picture.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'No image selected.');
            }
        }
    
        return $this->redirect(['index']);
    }
    
    



    public function actionPassword() {
        $model = $this->findModel(Yii::$app->user->id);
    
        if ($this->request->isPost && $model->load($this->request->post())) {
            
            // Check if old password is correct
            if (!$model->validatePassword($model->password)) {
                Yii::$app->session->setFlash('error', 'Incorrect current password.');
                return $this->redirect(['index']); // Redirect back to profile
            }
    
            // Update password if old password is correct
            $model->setPassword($model->newpassword);
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Password updated successfully.');
                return $this->redirect(['index']);
            }
    
            Yii::$app->session->setFlash('error', 'Failed to update password.');
        }
    
        return $this->redirect(['index']);
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

    protected function findModel($id) {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            return new Users();
        }
    }
}
