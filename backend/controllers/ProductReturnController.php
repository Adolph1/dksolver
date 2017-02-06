<?php

namespace backend\controllers;

use Yii;
use backend\models\ProductReturn;
use backend\models\Inventory;
use backend\models\ProductReturnSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductReturnController implements the CRUD actions for ProductReturn model.
 */
class ProductReturnController extends Controller
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
     * Lists all ProductReturn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductReturnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductReturn model.
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
     * Creates a new ProductReturn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductReturn();
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');
        $model->trn_dt=date('Y-m-d');


        if ($model->load(Yii::$app->request->post())) {

            $qty=Inventory::getQty($_POST['ProductReturn']['product_id']);
            if($_POST['ProductReturn']['return_type']==$model::PURCHASE_RETURN) {
                if ($qty > $_POST['ProductReturn']['qty']) {
                    $qty = $qty - $_POST['ProductReturn']['qty'];
                    Inventory::updateAll(['qty' => $qty], ['product_id' => $_POST['ProductReturn']['product_id']]);
                    $model->save();
                } else {

                    Yii::$app->session->setFlash('warning', 'Stock available is less than quantity');
                }
            }
            elseif($_POST['ProductReturn']['return_type']==$model::SALES_RETURN)
            {
                $qty = $qty + $_POST['ProductReturn']['qty'];
                Inventory::updateAll(['qty' => $qty], ['product_id' => $_POST['ProductReturn']['product_id']]);
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductReturn model.
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
     * Deletes an existing ProductReturn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        if($model->return_type==$model::PURCHASE_RETURN){
            $qty=Inventory::getQty($model->product_id);
            $qty=$qty+$model->qty;
            Inventory::updateAll(['qty'=>$qty],['product_id'=>$model->product_id]);
            $model->status='D';
            $model->save();
        }elseif ($model->return_type==$model::SALES_RETURN){
            $qty=Inventory::getQty($model->product_id);
            $qty=$qty-$model->qty;
            Inventory::updateAll(['qty'=>$qty],['product_id'=>$model->product_id]);
            $model->status='D';
            $model->save();

        }
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductReturn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductReturn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductReturn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
