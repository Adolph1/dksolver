<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\models\StockAdjustment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-adjustment-form">
    <div class="panel panel-success">
        <div class="panel-heading"><?= Yii::t('app','Stock Adjustment Form');?></div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "product_id")->dropDownList(Product::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'adjust_type')->dropDownList(['1'=>'Increase','0'=>'Decrease'],['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'qty')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
   <?= $form->field($model, 'stock_change')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
