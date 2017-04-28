<?php

namespace backend\controllers;

use backend\models\PurchaseSearch;
use Yii;
use backend\models\PurchaseInvoice;
use backend\models\PurchaseInvoiceSearch;
use backend\models\Model;
use backend\models\Purchase;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseInvoiceController implements the CRUD actions for PurchaseInvoice model.
 */
class PurchaseInvoiceController extends Controller
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
     * Lists all PurchaseInvoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseInvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurchaseInvoice model.
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
     * Creates a new PurchaseInvoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new PurchaseInvoice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    */


    public function actionCreate()
    {
        $model = new PurchaseInvoice();
        $purchases = [new Purchase()];
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->status=0;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $purchases = Model::createMultiple(Purchase::classname());
            Model::loadMultiple($purchases, Yii::$app->request->post());
            //  print_r($models);
            // exit;

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($purchases) && $valid;


             if ($valid) {


            $transaction = \Yii::$app->db->beginTransaction();
            //print_r($transaction);
            //exit;
            try {


                foreach ($purchases as $purchase) {

                    $purchase->prchs_dt=date('Y-m-d');
                    $purchase->purchase_invoice_id=$model->id;
                    $purchase->maker_id=Yii::$app->user->identity->username;
                    $purchase->maker_time=date('Y-m-d:H:i:s');
                    $purchase->auth_status='U';
                    $purchase->status=0;
                    if (!($flag = $purchase->save(false))) {
                        $transaction->rollBack();
                        break;
                    }
                    else{
                        $this->updateTotal($purchase->id,$purchase->qty,$purchase->price);
                    }
                }

                $transaction->commit();
                return $this->redirect(['purchase/index']);
            } catch (Exception $e) {
                $transaction->rollBack();
            }

        }
        }
        else {


            return $this->render('create', [
                'purchases' => (empty($purchases)) ? [new Purchase] : $purchases, 'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing PurchaseInvoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $purchases = $model->purchases;
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        if ($model->load(Yii::$app->request->post())) {

            //$oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
            $purchases = Model::createMultiple(Purchase::classname(), $purchases);
            Model::loadMultiple($purchases, Yii::$app->request->post());
           // $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($purchases) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        foreach ($purchases as $purchase) {
                            $purchase->purchase_invoice_id = $model->id;
                            $purchase->maker_id=Yii::$app->user->identity->username;
                            $purchase->maker_time=date('Y-m-d:H:i:s');
                            $purchase->auth_status='U';
                            if (! ($flag = $purchase->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                            else{
                                $this->updateTotal($purchase->id,$purchase->qty,$purchase->price);
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'purchases' => (empty($purchases)) ? [new Purchase()] : $purchases
        ]);
    }


    /**
     * Deletes an existing PurchaseInvoice model.
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
     * Finds the PurchaseInvoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseInvoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseInvoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findPurchase($id)
    {
        if (($model = Purchase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //updates Total amount

    protected function updateTotal($id,$qty,$price)
    {
        $model=$this->findPurchase($id);
        $model->total=$qty*$price;
        $model->save();
    }

    /**
     * Get all invoice entries
     */

    public function actionViewentries($id)
    {

        return $this->render('entry', [
            'invoice_number' => $id,

        ]);
    }
}
