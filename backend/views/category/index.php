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

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view} {edit} {block}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $url=['view','id' => $model->id];
                        return Html::a('<span class="fa fa-eye"></span>', $url, [
                            'title' => 'View',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-info',

                        ]);


                    },
                    'edit' => function ($url, $model) {
                        $url=['update','id' => $model->id];
                        return Html::a('<span class="fa fa-edit"></span>', $url, [
                            'title' => 'Edit',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-warning',

                        ]);


                    },
                    'block' => function ($url, $model) {
                        $url=['block','id' => $model->id];
                        return Html::a('<span class="fa fa-minus-square"></span>', $url, [
                            'title' => 'Block',
                            'data-toggle'=>'tooltip','data-original-title'=>'Save',
                            'class'=>'btn btn-danger',

                        ]);


                    }
                ]
            ],
        ],
    ]);?>



</div>
