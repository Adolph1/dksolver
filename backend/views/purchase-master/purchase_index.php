<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 1/17/17
 * Time: 7:05 PM
 */

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\PurchaseInvoice;
use backend\models\PurchaseCost;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="col-md-6">

    <table class="table table-bordered table-condensed table-hover small kv-table">
        <tbody><tr class="success">
            <th colspan="3" class="text-center text-success">Purchases summary</th>
        </tr>
        <tr class="active">
            <th class="text-center">#</th>
            <th>Description</th>
            <th class="text-right">Amount</th>
        </tr>
        <tr>
            <td class="text-center">1</td><td>Total Purchases</td><td class="text-right"><?= $tp=PurchaseInvoice::getTotal($model->id);?></td>
        </tr>
        <tr>
            <td class="text-center">2</td><td>Total Costs</td><td class="text-right"><?= $tc=PurchaseCost::getTotal($model->id);?></td>
        </tr>
        <tr>
            <td class="text-center">3</td><td>Total expected sales</td><td class="text-right"><?= $ts=PurchaseInvoice::getTotalSales($model->id);?></td>
        </tr>
        <tr class="warning">
            <th></th><th>Total expected Profit / Loss</th><th class="text-right"><?= $ts-($tp+$tc);?></th>
        </tr>
        </tbody></table>
</div>
<div class="col-md-6">

    <table class="table table-bordered table-condensed table-hover small kv-table">
        <tbody><tr class="danger">
            <th colspan="3" class="text-center text-danger">Costs summary</th>
        </tr>
        <tr class="active">
            <th class="text-center">#</th>
            <th>Description</th>
            <th class="text-right">Amount</th>
        </tr>
        <tr>
            <td class="text-center">1</td><td>Transport</td><td class="text-right">30.60 </td>
        </tr>
        <tr>
            <td class="text-center">2</td><td>Couriers</td><td class="text-right">2.04</td>
        </tr>
        <tr>
            <td class="text-center">3</td><td>Storage</td><td class="text-right">1.36</td>
        </tr>
        <tr>
            <td class="text-center">3</td><td>TRA</td><td class="text-right">1.36</td>
        </tr>
        <tr class="warning">
            <th></th><th>Total</th><th class="text-right">34.00</th>
        </tr>
        </tbody></table>
</div>

