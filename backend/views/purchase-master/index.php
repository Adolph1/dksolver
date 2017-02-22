<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use backend\models\PurchaseMaster;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchase Masters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-master-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'New Batch'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $gridColumns = [
        [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],
        [
            'class'=>'kartik\grid\ExpandRowColumn',
            'width'=>'50px',
            'value'=>function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'=>function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('purchase_index', ['model'=>$model]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style'],
            'expandOneOnly'=>true
        ],

        //'id',
        'description',
        [
                'attribute'=>'country',
                'value'=>function($model){
                    if($model->country==PurchaseMaster::LOCAL){
                        return "Local";
                    }
                    elseif ($model->country==PurchaseMaster::ABROAD){
                        return "Abroad";
                    }

                }
        ],
        'period',
        'financial_year',
        [
            'attribute'=>'fcy_rate',
            'value'=>function($model){
                if($model->country==PurchaseMaster::LOCAL){
                    return "-";
                }
                elseif ($model->country==PurchaseMaster::ABROAD){
                    return $model->fcy_rate;
                }

            }
        ],
        [
            'attribute'=>'lcy_rate',
            'value'=>function($model){
                if($model->country==PurchaseMaster::LOCAL){
                    return "-";
                }
                elseif ($model->country==PurchaseMaster::ABROAD){
                    return $model->lcy_rate;
                }

            }
        ],
        //'maker_id',
        //'maker_time',

        [
            'class'=>'yii\grid\ActionColumn',
            'header'=>'Actions',
            'template'=>'{view} {delete}',
            'buttons'=>[
                'view' => function ($url, $model) {
                    $url=['view','id' => $model->id];
                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => 'View',
                        'data-toggle'=>'tooltip','data-original-title'=>'Save',
                        'class'=>'btn btn-info',

                    ]);


                },

                'delete' => function ($url, $model) {
                    $url=['delete','id' => $model->id];
                    return Html::a('<span class="fa fa-times"></span>', $url, [
                        'title' => 'Delete',
                        'data-toggle'=>'tooltip','data-original-title'=>'Save',
                        'class'=>'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this batch?'),
                            'method' => 'post',
                        ],

                    ]);


                }
            ]
        ],

    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' =>  $gridColumns,
        //'showPageSummary'=>$pageSummary,
    ]); ?>
</div>
