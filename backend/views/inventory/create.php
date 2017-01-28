<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Inventory */

$this->title = Yii::t('app', 'Create Inventory');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
