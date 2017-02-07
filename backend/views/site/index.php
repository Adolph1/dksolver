<?php

/* @var $this yii\web\View */

$this->title = 'TangoPos';
use yii\bootstrap\Html;
?>
<div class="site-index" align="center">

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6" style="border-bottom: orange 2px solid;margin-left: 100px">
            <div class="row">
                <div class="col-md-12 text-center" style="background: orange;margin-left: 0px;color: white"><h3>Total Sales</h3></div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center"><h3 style="color: orange"><i class="fa fa-credit-card"></i> 455</h3></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" style="border-bottom: cornflowerblue 2px solid;margin-left: 5px">
            <div class="row">
                <div class="col-md-12 text-center" style="background: cornflowerblue;margin-left: 0px;color: white"><h3>Total Purchases</h3></div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center"><h3 style="color: cornflowerblue"><i class="fa fa-shopping-cart"></i> 455</h3></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" style="border-bottom: seagreen 2px solid;margin-left: 5px">
            <div class="row">
                <div class="col-md-12 text-center" style="background: seagreen;margin-left: 0px;color: white"><h3>Total Products</h3></div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center"><h3 style="color: seagreen"><i class="fa fa-th-large"></i> 455</h3></div>
            </div>
        </div>
    </div>


    <p style="padding: 10px" class="text-primary">Welcome to TangoPos, choose a common task below to get started!</p>


    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6" style="margin-left: 100px">
            <div class="row">
                <div class="col-md-12" style="background: white;color: skyblue;border-left: solid 2px skyblue"><h3> <?= Html::a(Yii::t('app', '<i class="fa fa-shopping-cart"></i> New Sale'), ['sales/create']) ?> </h3></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" style="margin-left: 5px">
            <div class="row">
                <div class="col-md-12" style="background: white;color: skyblue;border-left: solid 2px skyblue"><h3><?= Html::a(Yii::t('app', '<i class="fa fa-th-large"></i> New Product'), ['product/create']) ?> </h3></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" style="margin-left: 5px">
            <div class="row">
                <div class="col-md-12" style="background: white;color: skyblue;border-left: solid 2px skyblue"><h3><?= Html::a(Yii::t('app', '<i class="fa fa-th-large"></i> New Category'), ['category/create']) ?> </h3></div>
            </div>
        </div>
    </div>

    <p style="padding: 10px" class="text-primary">Get quick reports!</p>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6" style="margin-left: 100px">
            <div class="row">
                <div class="col-md-12" style="background: white;color: #5555;border-left: solid 2px skyblue;padding: 10px"><?= Html::a(Yii::t('app', '<i class="fa fa-bar-chart"></i> Today\'s sales report'), ['sales/index']) ?>  </div>
            </div>
        </div>

    </div>
</div>
