<?php

use yii\helpers\Html;
use backend\models\PurchaseInvoiceSearch;
use fedemotta\datatables\DataTables;
use backend\models\Purchase;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseInvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchase Invoices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-invoice-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'New Invoice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'invoice_number',
            'purchase_date',
            'supplier_id',
            'purchase_master_id',
            'maker_id',
            'maker_time',
            'checker_id',
            'checker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]);*/ ?>


    <?php
    $searchModel = new PurchaseInvoiceSearch();
   $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'invoice_number',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->invoice_number),['viewentries','id'=> $data->id]);
                },
            ],

            'purchase_date',
            [
                   'attribute'=>'supplier_id',
                    'value'=>'supplier.supplier_name'
            ],
            [
                'attribute'=>'purchase_master_id',
                'value'=>'purchaseMaster.description'
            ],
            [
                'attribute'=>'total_purchase',
                'value'=>function ($searchModel)
                {
                    return Purchase::getInvoiceTotal($searchModel->id);
                }
            ],
            [
                'attribute'=>'Stock Status',
                'value'=>function ($searchModel)
                {
                    if($searchModel->status==Purchase::PENDING) {

                        return 'Pending';
                    }
                    elseif($searchModel->status==Purchase::UPDATED){
                        return 'Stock Updated';
                    }
                }
            ],
            //'maker_id',
            //'maker_time',
            //'checker_id',
           // 'checker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],

    ]);?>

</div>
