<?php

use yii\helpers\Html;
use fedemotta\datatables\DataTables;
use backend\models\SalesSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Today\'s sales detailed report');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //$searchModel = new SalesSearch();
    //$dataProvider = $searchModel->searchTodaySales();
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'sales_id',
            'trn_dt',
            [
                    'attribute'=>'product_id',
                    'value'=>'product.product_name',
            ],
            'selling_price',
            'qty',
            'total',
            'maker_id',
            'maker_time',

        ],
        'clientOptions' => [
            "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
            "info"=>false,
            "responsive"=>true,
            "dom"=> 'lfTrtip',
            "tableTools"=>[
                "aButtons"=> [
                   [
                        "sExtends"=> "xls",
                        "oSelectorOpts"=> ["page"=> 'current']
                    ],
                    [
                        "sExtends"=> "pdf",
                        "sButtonText"=> Yii::t('app',"Save to PDF")
                    ],
                    [
                        "sExtends"=> "print",
                        "sButtonText"=> Yii::t('app',"Print")
                    ],
                ]
            ]
        ],

    ]);?>
</div>
