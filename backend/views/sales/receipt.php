<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 1/31/17
 * Time: 3:49 PM
 */
use backend\models\SalesItem;
use backend\models\Product;
?>
<?php
$sales=SalesItem::getAll($model->id);
$product=new Product();
?>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

    <table class="table table-bordered table-condensed table-hover small kv-table">
        <tbody><tr class="success">
            <th colspan="6" class="text-center text-success"></th>
        </tr>
        <tr class="active">
            <th class="text-center">Product Number</th>
            <th class="text-left">Product Name</th>
            <th class="text-left">Product Category</th>
            <th>Price</th>
            <th class="text-right">Quantity</th>
            <th class="text-right">Total</th>
        </tr>
        <?php
        foreach ($sales as $sale){
            echo '<tr><td class="text-center">'.$sale->product_id.'</td><td class="text-left">'.Product::getProductName($sale->product_id).'</td><td>'.\backend\models\Category::getName(Product::getCategoryID($sale->product_id)).'</td><td>'.$sale->selling_price.'</td><td class="text-right">'.$sale->qty.'</td><td class="text-right">'.$sale->total.'</td></tr>';
        }
        ?>
        <tr class="warning">
            <th></th><th><th></th><th></th><th>Total</th><th class="text-right">
                <?php
                $sum=0;
                foreach ($sales as $sale){
                   $sum=$sum+$sale->total;
                }
                echo $sum;
                ?>
            </th>
        </tr>
        </tbody></table>
</div>
</div>