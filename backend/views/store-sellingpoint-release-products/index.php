<?php

use backend\models\StoreSellingpointReleaseProducts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointReleaseProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Store Sellingpoint Release Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-sellingpoint-release-products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Store Sellingpoint Release Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'store_selling_point_id',
            'product_variation_id',
            'request_qty',
            'recieve_qty',
            'return_qty',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StoreSellingpointReleaseProducts $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'store_selling_point_id' => $model->store_selling_point_id, 'product_variation_id' => $model->product_variation_id]);
                 }
            ],
        ],
    ]); ?>


</div>
