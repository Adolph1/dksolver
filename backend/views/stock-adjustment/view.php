<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StockAdjustment */

$this->title = \backend\models\Product::getProductName($model->product_id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stock Adjustments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-adjustment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p style="float: right">
        <?= Html::a(Yii::t('app', 'New adjustment'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

    </p>
    <?php
    if($model->adjust_type==\backend\models\StockAdjustment::DECREASE){
        $adjust="Decreased";
    }
    elseif($model->adjust_type==\backend\models\StockAdjustment::INCREASE){
        $adjust="Increased";
    }
    $current_value=\backend\models\Inventory::getQty($model->product_id);
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product.product_name',
            [
                'attribute'=>'adjust_type',
                'value'=>$adjust,

            ],
           [
                   'attribute'=>'qty',
                    'value'=>$current_value,
           ],
            'stock_change',
            'amount',
            'total_amount',
            'description',
        ],
    ]) ?>

</div>
