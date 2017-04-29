<?php

namespace backend\controllers;

use backend\models\Inventory;
use backend\models\PurchaseInvoice;
use backend\models\PurchaseInvoiceSearch;
use backend\models\SystemSetup;
use Yii;
use backend\models\Purchase;
use backend\models\PurchaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller
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
     * Lists all Purchase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
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
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Purchase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Purchase model.
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
     * update current stock
     */

    public function actionUpdatestock()
    {
        $countpendings=Purchase::find()->where(['status'=>Purchase::PENDING])->count();

        if($countpendings>0){

            $pendings=Purchase::find()->where(['status'=>Purchase::PENDING])->all();
            if (SystemSetup::getMakerChecker() == SystemSetup::ALLOW_MAKERCHECKER) {
            foreach ($pendings as $pending) {

                    $productcount = Inventory::find()->where(['product_id' => $pending->product_id])->count();
                    if ($productcount == 1) {
                        $product = Inventory::find()->where(['product_id' => $pending->product_id])->one();
                        $prevbalance=$product->qty;
                        $product->qty = $product->qty + $pending->qty;
                        $product->maker_id = $pending->maker_id;
                        $product->maker_time = $pending->maker_time;
                        $product->checker_id = Yii::$app->user->identity->username;
                        $product->checker_time = date('Y-m-d:H:i:s');
                        $product->auth_status = 'A';
                        $product->save();
                        Purchase::updateAll(['status' => Purchase::UPDATED,'previous_balance'=>$prevbalance,'balance'=>$product->qty,'checker_id'=>Yii::$app->user->identity->username,'checker_time'=>date('Y-m-d:H:i:s'),'auth_status'=>'A'], ['id' => $pending->id]);

                    } else {
                        $product = new Inventory();
                        $product->product_id = $pending->product_id;
                        $product->buying_price = $pending->price;
                        $product->selling_price = $pending->selling_price;
                        $product->qty = $pending->qty;
                        $product->min_level = 5;
                        $product->last_updated = date('Y-m-d:H:i:s');
                        $product->maker_id = $pending->maker_id;
                        $product->maker_time = $pending->maker_time;
                        $product->checker_id = Yii::$app->user->identity->username;
                        $product->checker_time = date('Y-m-d:H:i:s');
                        $product->auth_status = 'A';
                        $product->save();
                        Purchase::updateAll(['status' => Purchase::UPDATED,'checker_id'=>Yii::$app->user->identity->username,'checker_time'=>date('Y-m-d:H:i:s'),'auth_status'=>'A'], ['id' => $pending->id]);

                    }

                }

                $countpendingsinvoices=PurchaseInvoice::find()->where(['status'=>Purchase::PENDING])->count();

                if($countpendingsinvoices>0) {

                    $pendingsinvoices=PurchaseInvoice::find()->where(['status'=>Purchase::PENDING])->all();
                    foreach ($pendingsinvoices as $pendingsinvoice) {
                        $productscount = Purchase::find()->where(['purchase_invoice_id' => $pendingsinvoice->id,'status'=>Purchase::PENDING])->count();
                        if($productscount==0){
                            PurchaseInvoice::updateAll(['status' => Purchase::UPDATED,'checker_id'=>Yii::$app->user->identity->username,'checker_time'=>date('Y-m-d:H:i:s')], ['id' => $pendingsinvoice->id]);
                        }
                    }

                }

                return $this->render('index');
            }
            else{
                Yii::$app->session->setFlash('danger', 'You dont have permition to update stock.');
                return $this->render('index');
            }
        }
        else{
            return $this->render('index');
        }
    }

    /**
     * Deletes an existing Purchase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    /**
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
