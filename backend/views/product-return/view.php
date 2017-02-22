<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductReturn */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Returns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-return-view">

    <h1><?php // Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'trn_dt',
            'return_type',
            'product_id',
            'price',
            'qty',
            'total',
            'source_ref_no',
            'description',
            'maker_id',
            'maker_time',
        ],
    ]) ?>

</div>
