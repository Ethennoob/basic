<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Po;
use app\modules\admin\models\PoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Poitem;
use app\modules\admin\models\Model;
use yii\helpers\ArrayHelper;

/**
 * PoController implements the CRUD actions for Po model.
 */
class PoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Po models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Po model.
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
     * Creates a new Po model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Po();
        $modelsPoitems = [new Poitem];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsPoitems = Model::createMultiple(Poitem::classname());
            Model::loadMultiple($modelsPoitems, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoitems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPoitems as $modelPoitem) {
                            $modelPoitem->po_id = $model->id;
                            if (! ($flag = $modelPoitem->save(false))) {
                                $transaction->rollBack();
                                break;
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
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsPoitems'=>(empty($modelsPoitems)) ? [new Poitem] : $modelsPoitems]);
        }
    }

    /**
     * Updates an existing Po model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$modelsPoitems = $model->poitems; oh that error !!!
        $modelsPoitems = Poitem::find()->where(['po_id'=>$id])->all();//it ture! :D

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsPoitems, 'id', 'id');
            $modelsPoitems = Model::createMultiple(Poitem::classname(), $modelsPoitems);
            Model::loadMultiple($modelsPoitems, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPoitems, 'id', 'id')));


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoitems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Poitem::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPoitems as $modelPoitem) {
                            $modelPoitem->po_id = $model->id;
                            if (! ($flag = $modelPoitem->save(false))) {
                                $transaction->rollBack();
                                break;
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
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsPoitems'=>(empty($modelsPoitems)) ? [new Poitem] : $modelsPoitems]);
        }
    }

    /**
     * Deletes an existing Po model.
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
     * Finds the Po model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Po the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Po::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
