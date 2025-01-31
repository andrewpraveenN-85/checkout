<?php

use backend\models\StoreFactoryReleaseRawItems;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryReleaseRawItemsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Store Factory Release Raw Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-factory-release-raw-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Store Factory Release Raw Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'stock_transfer_id',
            'raw_items_id',
            'request_qty',
            'receive_qty',
            'return_qty',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StoreFactoryReleaseRawItems $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'stock_transfer_id' => $model->stock_transfer_id, 'raw_items_id' => $model->raw_items_id]);
                 }
            ],
        ],
    ]); ?>


</div>
