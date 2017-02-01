<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-view">

    <div style="background: #fff">
        <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="row" style="padding: 10px;">
                <div class="col-md-6" style="border: dashed 1px #ccc;background: #eee">
                    <div class="side-heading">
                        Adotech Co Limited<br/>P.O.Box 79863,<br/>Dar es Salaam. </div>
                    <div class="text text-center">
                        </div>
                </div>
                <div class="col-md-6" style="border: dashed 1px #ccc;background: #eee">
                    <div class="side-heading">
                        Customer Name</div>
                    <div class="text text-center">
                        <span class="text-warning"><b><?= $model->customer_name;?><br/><br/></b></span>  </div>
                </div>
            </div>

        </div>
        </div>

        <?= Yii::$app->controller->renderPartial('receipt_view', ['model'=>$model]);?>



    </div>

</div>
