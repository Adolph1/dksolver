<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 1/17/17
 * Time: 7:05 PM
 */

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\PurchaseSearch;
use fedemotta\datatables\DataTables;

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

            'id',
            'invoice_number',
            'purchase_date',
            'product_id',
            'price',
            'qty',
            'total',
            'supplier_id',
            'purchase_master_id',
            'maker_id',
            'maker_time',
            'auth_status',
            'checker_id',
            'checker_time',

        ],
    ]); ?>
</div>
