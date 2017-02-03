<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\models\PriceMaintanance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-maintanance-form">
    <div class="panel panel-success">
        <div class="panel-heading"><?= Yii::t('app','Price Maintenance Form');?></div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-12"><?= $form->field($model, "product_id")->dropDownList(Product::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'old_price')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?></div>

        <div class="col-md-6"><?= $form->field($model, 'new_price')->textInput(['maxlength' => true]) ?></div>
        </div>
            <div class="row">
                <div class="col-md-12"><?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>
                </div>
                </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
