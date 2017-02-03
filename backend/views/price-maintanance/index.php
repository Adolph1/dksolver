<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceMaintananceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Price Maintenance');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-maintanance-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Change Price'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $searchModel = new \backend\models\PriceMaintananceSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
<?php Pjax::begin(); ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           [
                   'attribute'=>'product_id',
                    'value'=>'product.product_name',
           ],
            'old_price',
            'new_price',
            'reason',
            'maker_id',
            'maker_time',



        ],
    ]); ?>
<?php Pjax::end(); ?></div>
