<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use backend\models\Report;

/* @var $this yii\web\View */
/* @var $model backend\models\ReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="panel panel-success">
        <div class="panel-heading"><?= Yii::t('app','Report engine');?></div>
        <div class="panel-body">
            <div class="row"> <div class="col-md-12"><?= $form->field($model, 'report')->dropDownList(Report::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?></div></div>
            <div id="dates">
            <div class="row">
    <div class="col-md-6"><?= $form->field($model, 'from')->widget(DatePicker::ClassName(),
        [
            'name' => 'from',
            // 'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'From date ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);?>
    </div>
            <div class="col-md-6"><?= $form->field($model, 'to')->widget(DatePicker::ClassName(),
        [
            'name' => 'to',
            // 'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'To date...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);?>
            </div>
            </div>

            </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
