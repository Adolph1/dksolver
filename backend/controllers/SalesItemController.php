<?php

namespace backend\controllers;

use Yii;
use backend\models\SalesItem;
use backend\models\Inventory;
use backend\models\SalesItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Sales;

/**
 * SalesItemController implements the CRUD actions for SalesItem model.
 */
class SalesItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SalesItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SalesItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SalesItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SalesItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SalesItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SalesItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        if($model->delete_stat!=Sales::DELETED) {

            $model->delete_stat = Sales::DELETED;
            $model->save();

            //updates inventory
            $currentsctock = Inventory::getQty($model->product_id);
            $currentsctock = $currentsctock + $model->qty;

            //updates Sales
            $sales = Sales::getSale($model->sales_id);
            $sales->total_qty = $sales->total_qty - $model->qty;
            $sales->total_amount = $sales->total_amount - ($model->qty * $model->selling_price);
            $sales->paid_amount = $sales->paid_amount - ($model->qty * $model->selling_price);
            $sales->save();

            Inventory::updateAll(['qty' => $currentsctock], ['product_id' => $model->product_id]);
            Yii::$app->session->setFlash('danger', 'Successfully deleted');
            return $this->redirect(['sales/view', 'id' => $model->sales_id]);
        }
        else{
            Yii::$app->session->setFlash('warning', 'Nothing to delete');
            return $this->redirect(['sales/view', 'id' => $model->sales_id]);
        }
    }

    /**
     * Finds the SalesItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalesItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
