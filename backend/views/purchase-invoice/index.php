<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchaseInvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Purchase Invoices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Purchase Invoice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'invoice_number',
            'purchase_date',
            'supplier_id',
            'purchase_master_id',
            // 'maker_id',
            // 'maker_time',
            // 'checker_id',
            // 'checker_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
