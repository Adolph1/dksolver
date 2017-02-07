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
        <?php // Html::a(Yii::t('app', 'Create Purchase'), ['create'], ['class' => 'btn btn-success']) ?>
        <span style="float: right;padding-bottom: 10px"><?= Html::a(Yii::t('app', '<i class="fa fa-check"></i>  Update Stock'), ['updatestock'], ['class' => 'btn btn-warning']) ?></span>
    </p>
    <?php
    $searchModel = new PurchaseSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'purchase_invoice_id',
                'value'=>'purchaseInvoice.invoice_number',
            ],
            [
                'attribute'=>'product_id',
                'value'=>'product.product_name',
            ],
            'price',
            'qty',
            'total',

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
            //'maker_id',
           // 'maker_time',
            'auth_status',
           // 'checker_id',
            //'checker_time',


           // ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]);?>

</div>
