<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use backend\models\InventorySearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InventorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products in Stock');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Create Inventory'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $searchModel = new InventorySearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            [
                    'attribute'=>'product_id',
                    'value'=>'product.product_name'
            ],
            'buying_price',
            'selling_price',
            'qty',
            'min_level',
            'last_updated',
            //'maker_id',
           // 'maker_time',
            'auth_status',
            //'checker_id',
            //'checker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>
</div>
