<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="panel panel-success">
        <div class="panel-heading">Category Form</div>
        <div class="panel-body">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->dropDownList(Category::getAll(),['prompt'=>'--Select--']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
</div>
