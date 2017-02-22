<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\PurchaseSearch;
use fedemotta\datatables\DataTables;
use backend\models\Purchase;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchases');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

        <span style="float: right;padding-bottom: 10px">
            <?php if(Purchase::getUnauthorised($invoice_number)>0){?><?= Html::a(Yii::t('app', '<i class="fa fa-check"></i>  Update Stock'), ['purchase/updatestock'], ['class' => 'btn btn-warning']) ?>
            <?php }?>
 <?= Html::a(Yii::t('app', '<i class="fa fa-reply"></i> '), ['index'], ['class' => 'btn btn-default','data-toggle'=>'tooltip','data-original-title'=>'Back']) ?>
            </span>
    </p>
    <?php
   $searchModel = new PurchaseSearch();
    $dataProvider = $searchModel->searchentry($invoice_number);
    //print($invoice_number);
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'product_id',
                'value'=>'product.product_name',
            ],
            'price',
            'qty',
            'total',
            [
                'attribute'=>'purchase_invoice_id',
                'value'=>'purchaseInvoice.invoice_number',
            ],
            [
                'attribute'=>'Stock Status',
                'value'=>function ($searchModel)
                {
                    if($searchModel->status==Purchase::PENDING) {

                        return 'Pending';
                    }
                    elseif($searchModel->status==Purchase::UPDATED){
                        return 'Updated';
                    }
                }
            ],
            'maker_id',
            'maker_time',
            'auth_status',
            'checker_id',
            'checker_time',


           // ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
        /*'clientOptions' => [
            "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
            "info"=>false,
            "responsive"=>true,
            "dom"=> 'lfTrtip',
            "tableTools"=>[
                "aButtons"=> [
                    [
                        "sExtends"=> "copy",
                        "sButtonText"=> Yii::t('app',"Copy to clipboard")
                    ],[
                        "sExtends"=> "csv",
                        "sButtonText"=> Yii::t('app',"Save to CSV")
                    ],[
                        "sExtends"=> "xls",
                        "oSelectorOpts"=> ["page"=> 'current']
                    ],[
                        "sExtends"=> "pdf",
                        "sButtonText"=> Yii::t('app',"Save to PDF")
                    ],[
                        "sExtends"=> "print",
                        "sButtonText"=> Yii::t('app',"Print")
                    ],
                ]
            ]
        ],
        */
    ]);?>

</div>
