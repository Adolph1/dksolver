<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PriceMaintanance */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Price Maintanance',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Price Maintanances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="price-maintanance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
