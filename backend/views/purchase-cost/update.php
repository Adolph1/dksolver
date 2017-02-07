<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseCost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Purchase Cost',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchase Costs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="purchase-cost-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
