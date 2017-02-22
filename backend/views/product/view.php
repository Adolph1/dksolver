<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div style="float: right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>
<div class="row">
<div class="panel panel-success">
    <div class="panel-heading"><?= Yii::t('app','Product Details');?></div>
    <div class="panel-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'product_code',
                'barcode',
                'product_name',
                'description:ntext',
                'category0.title',
                //'image',
                'status',
                'maker_id',
                'maker_time',
                //'auth_status',
                // 'checker_id',
                // 'checker_time',
            ],
        ]) ?>
    </div>
</div>
</div>
