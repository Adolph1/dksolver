<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 1/31/17
 * Time: 3:49 PM
 */
use backend\models\SalesItem;
use backend\models\Product;
use yii\helpers\Html;
?>
<?php
$sales=SalesItem::getAll($model->id);
$product=new Product();
$fmt=Yii::$app->formatter;
?>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
    <div style="float: right"><b>Date: <?= $model->trn_dt;?> | Receipt Number: <?= $model->id;?></b></div>
    <table class="table table-bordered table-condensed table-hover small kv-table">
        <tbody>
        <tr class="active">
            <th class="text-left">Product Name</th>
            <th>Price</th>
            <th class="text-right">Quantity</th>
            <th class="text-right">Total</th>
        </tr>
        <?php
        foreach ($sales as $sale){
            echo '<tr><td class="text-left">'.Product::getProductName($sale->product_id).'</td><td>'.$sale->selling_price.'</td><td class="text-right">'.$sale->qty.'</td><td class="text-right">'.$sale->total.'</td></tr>';
        }
        ?>
        <tr class="warning">
     <th></th><th></th><th>Total</th><th class="text-right">
                <?php
                $sum=0;
                foreach ($sales as $sale){
                   $sum=$sum+$sale->total;
                }
                echo $fmt->asDecimal($sum,2);
                ?>
            </th>
        </tr>
        </tbody>
    </table>
   <div style="float: right;padding-bottom: 10px"> <?= Html::a(Yii::t('app', '<i class="fa fa-times"></i> Delete'), ['update', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>  <?= Html::a(Yii::t('app', '<i class="fa fa-print"></i> Print'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></div>
</div>
</div>