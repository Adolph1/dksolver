<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StockAdjustmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stock Adjustments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-adjustment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Stock Adjustment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                    'attribute'=>'product_id',
                    'value'=>'product.product_name'
            ],
            [
                'attribute'=>'adjust_type',
                'value'=>function ($model){
                    if($model->adjust_type==\backend\models\StockAdjustment::DECREASE){
                        return "Decreased";
                    }elseif($model->adjust_type==\backend\models\StockAdjustment::INCREASE){
                        return "Increased";
                    }
                }
            ],
            'qty',
            //'amount',
            // 'total_amount',
             'description',
            // 'maker_id',
            // 'maker_time',
            // 'auth_status',
            // 'checker_id',
            // 'checker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
