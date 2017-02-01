<?php

namespace backend\controllers;

use backend\models\Cart;
use Yii;
use backend\models\Inventory;
use backend\models\InventorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InventoryController implements the CRUD actions for Inventory model.
 */
class InventoryController extends Controller
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
     * Lists all Inventory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inventory model.
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
     * Creates a new Inventory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inventory model.
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
     * Deletes an existing Inventory model.
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
     * Finds the Inventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Load product
     */

    public function actionSearch($id)
    {
        $productcount=Inventory::find()->where(['product_id'=>trim($id)])->count();
        if($productcount>0) {


            $product = Inventory::find()->where(['product_id' => trim($id)])->one();

            $count = Cart::find()->where(['product_id' => $id])->count();
            if ($count > 0) {
                $cart = Cart::find()->where(['product_id' => $id])->one();
                $cart->qty = $cart->qty + 1;
                $cart->total = $cart->price * $cart->qty;
                $cart->maker_id = Yii::$app->user->identity->username;
                $cart->maker_time = date('Y-m-d:H:i:s');
                $cart->save();
            } else {
                $cart = new Cart();
                $cart->product_id = $id;
                $cart->qty = 1;
                $cart->price = $product->selling_price;
                $cart->total = $cart->price * $cart->qty;
                $cart->maker_id = Yii::$app->user->identity->username;
                $cart->maker_time = date('Y-m-d:H:i:s');
                $cart->save();
            }
        }
        else{
            return " ";
        }

    }
}
