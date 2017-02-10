<?php

use backend\models\Product;
use backend\models\Inventory;
use yii\bootstrap\Html;


$products=Inventory::getMinLevelProducts();
$product=new Product();
$this->title = 'Products under level';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered table-condensed table-hover small kv-table">
            <tbody><tr class="danger">
                <th colspan="6" class="text-center text-success"><h1><?= Html::encode($this->title) ?></h1></th>
            </tr>
            <tr class="active">
                <th class="text-left">Product Name</th>
                <th class="text-left">Product Category</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Minimum Level</th>
            </tr>
            <?php
            foreach ($products as $product) {
           if($product->min_level>$product->qty){
               echo '<tr><td class="text-left">'.Product::getProductName($product->product_id).'</td><td>'.\backend\models\Category::getName(Product::getCategoryID($product->product_id)).'</td><td  class="text-center">'.$product->qty.'</td><td  class="text-center">'.$product->min_level.'</td></tr>';
           }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>