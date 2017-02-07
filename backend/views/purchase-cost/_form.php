<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\PurchaseMaster;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseCost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-cost-form">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-bars bg-success"></i> Purchase Cost Form</h4></div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purchase_master_id')->dropDownList(PurchaseMaster::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
