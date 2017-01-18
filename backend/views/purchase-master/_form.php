<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PurchaseMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">Purchase Period Form</div>
            <div class="panel-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'period')->dropDownList(['0'=>'--Select--','M01'=>'M01','M02'=>'M02','M03'=>'M03','M04'=>'M04','M05'=>'M05','M06'=>'M06','M07'=>'M07','M08'=>'M08','M09'=>'M09','M10'=>'M10','M11'=>'M11','M12'=>'M12']) ?>

    <?= $form->field($model, 'financial_year')->textInput(['maxlength' => true,'value'=>'FY'.date('Y'),'readonly'=>'readonly']) ?>

    <?= $form->field($model, 'fcy_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lcy_rate')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>
