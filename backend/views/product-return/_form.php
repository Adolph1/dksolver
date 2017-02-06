<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\Product;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductReturn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-return-form">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-refresh"></i> Return Form</h4></div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, "product_id")->dropDownList(Product::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>
                </div>
            </div>
    <div class="row">
        <div class="col-md-12">
    <?= $form->field($model, 'return_type')->dropDownList([$model::SALES_RETURN=>'Sales Return',$model::PURCHASE_RETURN=>'Purchase Return'],['prompt'=>'--Select--']) ?>
        </div>
    </div>

     <div class="row">
                <div class="col-md-4">
    <?= $form->field($model, 'price')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                </div>
                <div class="col-md-4">
    <?= $form->field($model, 'qty')->textInput(['maxlength' => true,'onblur'=>'jsDispalyTotal(this)','onkeyup'=>'jsDispalyTotal(this)']) ?>
                </div>
         <div class="col-md-4">
    <?= $form->field($model, 'total')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
         </div>
     </div>
            <div class="row">
                <div class="col-md-12">
    <?= $form->field($model, 'source_ref_no')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
                </div>
            </div>
    <?php ActiveForm::end(); ?>

            <script>
                function jsDispalyTotal(data)
                {
                    var price=document.getElementById('productreturn-price').value;
                    var qty=document.getElementById('productreturn-qty').value;

                        document.getElementById("productreturn-total").value = qty*price;

                }
            </script>
        </div>
    </div>
</div>
