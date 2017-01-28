<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemSetupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-setup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tax') ?>

    <?= $form->field($model, 'discount') ?>

    <?= $form->field($model, 'currency') ?>

    <?= $form->field($model, 'shop_name') ?>

    <?php // echo $form->field($model, 'shop_category') ?>

    <?php // echo $form->field($model, 'maker_checker') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
