<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InventorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'buying_price') ?>

    <?= $form->field($model, 'selling_price') ?>

    <?= $form->field($model, 'qty') ?>

    <?php // echo $form->field($model, 'min_level') ?>

    <?php // echo $form->field($model, 'last_updated') ?>

    <?php // echo $form->field($model, 'maker_id') ?>

    <?php // echo $form->field($model, 'maker_time') ?>

    <?php // echo $form->field($model, 'auth_status') ?>

    <?php // echo $form->field($model, 'checker_id') ?>

    <?php // echo $form->field($model, 'checker_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
