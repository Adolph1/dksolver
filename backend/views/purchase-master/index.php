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
        <?= Html::a(Yii::t('app', 'New Purchase Period'), ['create'], ['class' => 'btn btn-success']) ?>
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

        ['class'=>'kartik\grid\ActionColumn'],

    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' =>  $gridColumns,
        //'showPageSummary'=>$pageSummary,
    ]); ?>
</div>
