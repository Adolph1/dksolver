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

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view} {edit} {block}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },
                       'edit' => function ($url, $model) {
                        $url=['update','id' => $model->id];
                        return Html::a('<span class="fa fa-edit"></span>', $url, [
                        'title' => 'Edit',
                        'data-toggle'=>'tooltip','data-original-title'=>'Save',
                        'class'=>'btn btn-warning',

                    ]);


                    },
                    'block' => function ($url, $model) {
                        $url=['block','id' => $model->id];
                        return Html::a('<span class="fa fa-minus-square"></span>', $url, [
                            'title' => 'Block',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-danger',

                        ]);


                    }
                ]
            ],
        ],
    ]);?>


</div>
