<?php

namespace backend\controllers;

use backend\models\Cart;
use backend\models\CartSearch;
use backend\models\Inventory;
use backend\models\SalesItem;
use Yii;
use backend\models\Sales;
use backend\models\SalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesController implements the CRUD actions for Sales model.
 */
class SalesController extends Controller
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
     * Lists all Sales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sales model.
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
     * Creates a new Sales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sales();
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->searchbyuser();

        $cartcounts=Cart::find()->where(['maker_id'=>Yii::$app->user->identity->username])->count();

        if($cartcounts>0) {
            $carts = Cart::find()->where(['maker_id' => Yii::$app->user->identity->username])->all();


            if ($model->load(Yii::$app->request->post())) {
                $model->trn_dt = date('Y-m-d');
                $model->maker_id = Yii::$app->user->identity->username;
                $model->maker_time = date('Y-m-d:H:i:s');
                $model->total_amount = Cart::getCartTotal();
                $model->total_qty = Cart::getCartTotalQty();

                if($_POST['Sales']['payment_method']==Sales::CASH) {

                    if ($model->total_amount == ($_POST['Sales']['paid_amount']+$_POST['Sales']['discount'])) {
                        $model->status = Sales::PAID;
                        $model->due_amount = 0;
                    } elseif ($model->total_amount > ($_POST['Sales']['paid_amount']+$_POST['Sales']['discount'])) {
                        $model->status = Sales::CREDIT;
                        $model->due_amount = $model->total_amount - ($_POST['Sales']['paid_amount']+$_POST['Sales']['discount']);
                    } elseif ($model->total_amount < $_POST['Sales']['paid_amount']) {

                        Yii::$app->session->setFlash('danger', 'Payment can not be greater than total amount.');

                        return $this->render('create', [
                            'model' => $model, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider
                        ]);

                    }
                }elseif($_POST['Sales']['payment_method']==Sales::ONCREDIT) {
                    if ($model->total_amount == ($_POST['Sales']['paid_amount']+$_POST['Sales']['discount'])) {
                        $model->status = Sales::CREDIT;
                        $model->paid_amount=0;
                        $model->due_amount = $model->total_amount;
                    } elseif ($model->total_amount > ($_POST['Sales']['paid_amount']+$_POST['Sales']['discount'])) {
                        $model->status = Sales::CREDIT;
                        $model->due_amount = $model->total_amount - ($_POST['Sales']['paid_amount']+$_POST['Sales']['discount']);
                    } elseif ($model->total_amount < $_POST['Sales']['paid_amount']) {

                        Yii::$app->session->setFlash('danger', 'Payment can not be greater than total amount.');

                        return $this->render('create', [
                            'model' => $model, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider
                        ]);

                    }
                }


                    if ($model->save()) {
                        foreach ($carts as $cart) {
                            $entries = new SalesItem();
                            $entries->product_id = $cart->product_id;
                            $entries->trn_dt = date('Y-m-d');
                            $entries->sales_id = $model->id;
                            $entries->selling_price = $cart->price;
                            $entries->qty = $cart->qty;
                            $entries->total = $cart->total;
                            $entries->maker_id = $model->maker_id;
                            $entries->maker_time = $model->maker_time;
                            if ($entries->save()) {
                                $inqty=Inventory::getQty($cart->product_id);
                                $prevbalance=$inqty;
                                $inqty=$inqty-$cart->qty;
                                Inventory::updateAll(['qty'=>$inqty],['product_id'=>$cart->product_id]);
                                SalesItem::updateAll(['previous_balance'=>$prevbalance,'balance'=>$inqty],['sales_id'=>$entries->sales_id,'product_id'=>$cart->product_id]);

                                Cart::deleteAll(['id' => $cart->id]);
                            } else {

                            }
                        }

                        Yii::$app->session->setFlash('success', 'Successfully saved.');

                        return $this->redirect(['view', 'id' => $model->id]);
                }

            } else {
                return $this->render('create', [
                    'model' => $model, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider
                ]);
            }
        }
        else{
            return $this->render('create', [
                'model' => $model, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider
            ]);
        }

    }

    /**
     * Updates an existing Sales model.
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
     * Deletes an existing Sales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        if($model->status!=Sales::DELETED) {
            $model->status = Sales::DELETED;
            $salesItems = SalesItem::getAllActive($id);
            if ($salesItems != null) {
                foreach ($salesItems as $salesItem) {
                    $inventory = Inventory::getQty($salesItem->product_id);
                    $inventory = $inventory + $salesItem->qty;
                    Inventory::updateAll(['qty' => $inventory], ['product_id' => $salesItem->product_id]);
                    SalesItem::updateAll(['delete_stat' => Sales::DELETED], ['sales_id' => $salesItem->sales_id]);
                }
            }
            $model->save();
            Yii::$app->session->setFlash('danger','Successfully deleted');
            return $this->redirect(['index']);
        }
        else
        {
            Yii::$app->session->setFlash('warning','Nothing to delete');
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the Sales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }





}
