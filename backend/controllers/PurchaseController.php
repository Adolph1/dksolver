<?php

namespace backend\controllers;

use backend\models\Model;
use Yii;
use backend\models\Purchase;
use backend\models\PurchaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\Response;

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
        $newpurchase = new Purchase();
        $models = [new Purchase()];
        if ($newpurchase->load(Yii::$app->request->post())) {
            $models = Model::createMultiple(Purchase::classname());
            Model::loadMultiple($models, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($models),
                    ActiveForm::validate($models)
                );
            }

            // validate all models
            $valid = $newpurchase->validate();
            $valid = Model::validateMultiple($models) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                        foreach ($models as $model) {
                            $model->purchase_master_id = $_POST['Purchase']['purchase_master_id'];
                            $model->supplier_id = $_POST['Purchase']['supplier_id'];
                            $model->purchase_date = $_POST['Purchase']['purchase_date'];
                            $model->invoice_number = $_POST['Purchase']['invoice_number'];
                            $model->save();

                           /* if (! ($flag = $model->save(false))) {
                                $transaction->rollBack();
                                break;
                            }*/
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
                'models' => (empty($models)) ? [new Purchase] : $models, 'newpurchase' => $newpurchase
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
