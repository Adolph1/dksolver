<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Sales */

$this->title = Yii::t('app', 'Create Sales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
