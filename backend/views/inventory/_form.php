<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Inventory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'buying_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'selling_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_level')->textInput() ?>

    <?= $form->field($model, 'last_updated')->textInput() ?>

    <?= $form->field($model, 'maker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_time')->textInput() ?>

    <?= $form->field($model, 'auth_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checker_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checker_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
