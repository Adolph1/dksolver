<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Purchase */

$this->title = Yii::t('app', 'Create Purchase');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,'newpurchase'=>$newpurchase
    ]) ?>

</div>
