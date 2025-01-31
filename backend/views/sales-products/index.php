<?php

use backend\models\SalesProducts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SalesProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sales Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sales Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sales_id',
            'product_variation_id',
            'quantity',
            'price',
            'discount',
            //'total',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SalesProducts $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'sales_id' => $model->sales_id, 'product_variation_id' => $model->product_variation_id]);
                 }
            ],
        ],
    ]); ?>


</div>
