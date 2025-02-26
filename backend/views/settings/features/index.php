<?php

use backend\models\CompanyFeatures;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CompanyFeaturesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Company Features';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-features-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Company Features', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'name',
            'isStores',
            'isFactory',
            //'isSellingPoint',
            //'isHR',
            //'isAccount',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CompanyFeatures $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
