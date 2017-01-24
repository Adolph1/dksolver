<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use dosamigos\datepicker\DatePicker;
use backend\models\Supplier;
use backend\models\PurchaseMaster;
use backend\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="customer-form">
    <div class="panel panel-default">
    <div class="panel-heading"><h4><i class="fa fa-bars bg-success"></i> Purchase Invoice Form</h4></div>
    <div class="panel-body">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-2"><?= $form->field($newpurchase, 'invoice_number')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-2"><?= $form->field($newpurchase, 'purchase_master_id')->dropDownList(PurchaseMaster::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?></div>
        <div class="col-md-2"><?= $form->field($newpurchase, 'supplier_id')->dropDownList(Supplier::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?></div>
        <div class="col-md-2"><?= $form->field($newpurchase, 'purchase_date')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-2">
            <?php /* $form->field($newpurchase, 'purchase_date')->widget(
                DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                // 'template' => '<div class="well well-sm" style="background-color: #fff;>{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy'
                ]
            ]);*/
            ?>

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-th-large bg-success"></i> Products</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 5, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $models[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'product_id',
                    'price',
                    'qty',
                    'total'
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <div class="item"><!-- widgetBody -->
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>

                <?php foreach ($models as $i => $model): ?>

                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (! $model->isNewRecord) {
                                echo Html::activeHiddenInput($model, "[{$i}]id");
                            }
                            ?>
                             <div class="col-md-4"><?= $form->field($model, "[{$i}]product_id")->dropDownList(Product::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?></div>
                            <div class="col-md-1"><?= $form->field($model, "[{$i}]price")->textInput(['maxlength' => true]) ?></div>
                            <div class="col-md-1"><?= $form->field($model, "[{$i}]qty")->textInput(['maxlength' => true]) ?></div>
                            <div class="col-md-1"><?= $form->field($model, "[{$i}]total")->textInput(['maxlength' => true]) ?></div>

                        </div>

                <?php endforeach; ?>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($newpurchase->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    </div>
    </div>

    <script>
        $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
            console.log("beforeInsert");
        });

        $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
            console.log("afterInsert");
        });

        $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
            if (! confirm("Are you sure you want to delete this item?")) {
                return false;
            }
            return true;
        });

        $(".dynamicform_wrapper").on("afterDelete", function(e) {
            console.log("Deleted item!");
        });

        $(".dynamicform_wrapper").on("limitReached", function(e, item) {
            alert("Limit reached");
        });
    </script>
</div>
