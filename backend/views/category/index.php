<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use backend\models\CategorySearch;
use backend\models\Category;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?php // Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="padding-bottom: 50px">
        <?= Html::a(Yii::t('app', 'Add Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'parent',
            'description',
            'maker_id',
            'maker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]);*/ ?>

    <?php
    $searchModel = new CategorySearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    ?>
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //columns
            //'id',
            'title',
            [
                    'attribute'=>'parent',
                    'value'=>function ($searchModel)
                    {
                        return Category::getParent($searchModel->parent);
                    }
            ],
            'description',
            'maker_id',
            'maker_time',

            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
        'clientOptions' => [
            "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
            "info"=>false,
            "responsive"=>true,
            "dom"=> 'lfTrtip',
            "tableTools"=>[
                "aButtons"=> [
                    [
                        "sExtends"=> "copy",
                        "sButtonText"=> Yii::t('app',"Copy to clipboard")
                    ],[
                        "sExtends"=> "csv",
                        "sButtonText"=> Yii::t('app',"Save to CSV")
                    ],[
                        "sExtends"=> "xls",
                        "oSelectorOpts"=> ["page"=> 'current']
                    ],[
                        "sExtends"=> "pdf",
                        "sButtonText"=> Yii::t('app',"Save to PDF")
                    ],[
                        "sExtends"=> "print",
                        "sButtonText"=> Yii::t('app',"Print")
                    ],
                ]
            ]
        ],
    ]);?>



</div>
