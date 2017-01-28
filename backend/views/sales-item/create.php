<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SalesItem */

$this->title = Yii::t('app', 'Create Sales Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
