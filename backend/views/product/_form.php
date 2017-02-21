<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div>

    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-1',
                    'wrapper' => 'col-sm-9',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]) ?>
        <div class="form-group text-right">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="fa fa-save"></i> ') : Yii::t('app', 'Update'), ['data-toggle'=>'tooltip','data-original-title'=>'Save','class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>  <?= Html::a(Yii::t('app', '<i class="fa fa-reply"></i> '), ['index'], ['class' => 'btn btn-default','data-toggle'=>'tooltip','data-original-title'=>'Back']) ?>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading"><?= Yii::t('app','Product Form');?></div>
            <div class="panel-body">



    <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category')->dropDownList(Category::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['-1'=>Yii::t('app','--Select--'),'0'=>'Active','1'=>'Disable']) ?>

    <?php // $form->field($model, 'auth_status')->textInput(['maxlength' => true,'visible'=>!$model->isNewRecord]) ?>




    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
