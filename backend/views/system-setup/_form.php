<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SystemSetup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="system-setup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shop_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shop_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_checker')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
