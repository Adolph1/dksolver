<?php

namespace backend\controllers;

use Yii;
use backend\models\StockAdjustment;
use backend\models\StockAdjustmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Inventory;

/**
 * StockAdjustmentController implements the CRUD actions for StockAdjustment model.
 */
class StockAdjustmentController extends Controller
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
     * Lists all StockAdjustment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StockAdjustmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StockAdjustment model.
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
     * Creates a new StockAdjustment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StockAdjustment();
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post())) {

            $model->amount=Inventory::getPrice($_POST['StockAdjustment']['product_id']);
            $model->total_amount=$model->amount*$_POST['StockAdjustment']['stock_change'];

            if($model->save()) {

                if ($model->adjust_type ==StockAdjustment::INCREASE) {

                    $newInventory = $model->qty + $model->stock_change;
                } elseif ($model->adjust_type == StockAdjustment::DECREASE) {

                    $newInventory = $model->qty - $model->stock_change;
                    if ($newInventory < 0) {
                        $newInventory = 0;
                    }
                }

                Inventory::updateAll(['qty' => $newInventory], ['product_id' => $model->product_id]);

                Yii::$app->session->setFlash('success', 'Successfully changed');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StockAdjustment model.
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
     * Deletes an existing StockAdjustment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        if($model->delete_status==null) {
            $model->delete_status = 'D';
            if ($model->save()) {
                $cqty = Inventory::getQty($model->product_id);

                if ($model->adjust_type == StockAdjustment::DECREASE) {
                    $nqty = $cqty + $model->stock_change;
                    Inventory::updateAll(['qty' => $nqty],['product_id' => $model->product_id]);
                    $model->qty=$model->qty+$model->stock_change;
                    $model->save();
                    return $this->redirect(['index']);
                } elseif ($model->adjust_type == StockAdjustment::INCREASE) {
                    $nqty = $cqty - $model->stock_change;
                    Inventory::updateAll(['qty' => $nqty],['product_id' => $model->product_id]);
                    $model->qty=$model->qty-$model->stock_change;
                    $model->save();
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the StockAdjustment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StockAdjustment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StockAdjustment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
