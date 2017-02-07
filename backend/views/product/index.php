<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ProductSearch;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> New Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'product_code',
            'barcode',
            'product_name',
            'description:ntext',
            'category',
            // 'image',
            'status',
            'maker_id',
            'maker_time',
            'auth_status',
            'checker_id',
            'checker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
 */
 ?>

    <?php
    $searchModel = new ProductSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'product_code',
            //'barcode',
            'product_name',
            'description:ntext',
            [
              'attribute'=>'category',
                'value'=>'category0.title'
            ],
            // 'image',

            ['class' => 'yii\grid\ActionColumn','header'=>Yii::t('app',"Actions")],
        ],
    ]);?>


</div>
