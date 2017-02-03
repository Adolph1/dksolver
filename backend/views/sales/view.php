<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Product;
use backend\models\SalesItem;


/* @var $this yii\web\View */
/* @var $model backend\models\Sales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-view">
    <?php
    $sales=SalesItem::getAll($model->id);
    $product=new Product();
    $fmt=Yii::$app->formatter;
    ?>
<div class="row">
    <div class="form-group text-right" style="border-top:solid 2px orange;padding-top:10px;">
        <?= Html::a(Yii::t('app', '<i class="fa fa-times"></i>'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this Sale?'),
                'method' => 'post',
            ],
        ]) ?>  <?= Html::a(Yii::t('app', '<i class="fa fa-reply"></i> '), ['index'], ['class' => 'btn btn-default','data-toggle'=>'tooltip','data-original-title'=>'Back']) ?>
    </div>
    <div class="col-md-12 text-center" style="background: #fff">
        <p style="padding-top: 10px;"><b>Sales No:<?= $model->id;?> | Date: <?= $model->trn_dt;?></b></p>
        <hr/>
    </div>
</div>
    <div class="row">
        <div class="col-md-12 text-left" style="background: #fff">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-1" style="border-bottom: solid 2px limegreen">Total Quantity: <?= $model->total_qty;?></div>
                <div class="col-md-1"></div>
                <div class="col-md-2" style="border-bottom: solid 2px limegreen">Total Amount: <?= $model->total_amount;?></div>
                <div class="col-md-1"></div>
                <div class="col-md-2" style="border-bottom: solid 2px orange">Amount Paid: <?= $model->paid_amount;?></div>
                <div class="col-md-1"></div>
                <div class="col-md-2" style="border-bottom: solid 2px indianred">Amount Due: <?= $model->due_amount;?></div>
            </div>
            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center" style="background: #fff">
            <p style="padding-top: 10px;"><b><i class="fa fa-th-large text-aqua"></i> Products List</b></p>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center" style="background: #fff">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr style="font-weight: 800">
                <td class="text-center">Product Name</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
                <td>Status</td>
                <td class="text-center">Action</td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($sales as $sale){

                if($sale->delete_stat=='D')
                {
                    $sale->delete_stat="Deleted";
                }
                elseif($sale->delete_stat==null)
                {
                    $sale->delete_stat="Sold";
                }
                echo '<tr>
                        <td class="text-center">'.Product::getProductName($sale->product_id).'</td>
                        <td>'.$sale->selling_price.'</td><td class="text-center">'.$sale->qty.'</td>
                        <td class="text-center">'.$sale->total.'</td>
                         <td class="text-center">'.$sale->delete_stat.'</td>
                        <td>
                        '.Html::a(Yii::t('app', '<i class="fa fa-times"></i>'), ['sales-item/delete', 'id' => $sale->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this product?'),
                            'method' => 'post',
                        ],
                    ]) .'
                     </td>
                     </tr>';
            }
            ?>

            </tbody>
        </table>
    </div>
        </div>
</div>
</div>
