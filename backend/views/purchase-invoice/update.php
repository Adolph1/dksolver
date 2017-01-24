<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseInvoice */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Purchase Invoice',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchase Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="purchase-invoice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'purchases'=>$purchases
    ]) ?>

</div>
