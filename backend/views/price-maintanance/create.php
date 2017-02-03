<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PriceMaintanance */

$this->title = Yii::t('app', 'New Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Price Maintenance'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-maintanance-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
