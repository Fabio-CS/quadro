<?php

namespace app\controllers;

use Yii;
use app\models\PeriodosAfastamento;
use app\models\PeriodosAfastamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PeriodosAfastamentoController implements the CRUD actions for PeriodosAfastamento model.
 */
class PeriodosAfastamentoController extends Controller
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
     * Lists all PeriodosAfastamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeriodosAfastamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PeriodosAfastamento model.
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
     * Creates a new PeriodosAfastamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PeriodosAfastamento();

        if ($model->load(Yii::$app->request->post())) {
            $model->criado_por = Yii::$app->user->getId();
             if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_periodo_afastamento]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PeriodosAfastamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->modificado_por = Yii::$app->user->getId();
            $model->modificado_em = date('Y-m-d G:i:s');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_periodo_afastamento]);
            }else{
                return $this->redirect(['update', 'model' => $model]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PeriodosAfastamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->modificado_por = Yii::$app->user->getId();
        $model->modificado_em = date('Y-m-d G:i:s');
        $model->ativo = 0;
        if($model->save()){
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('error', 'Erro ao deletar período de afastamento');
        return $this->redirect(['index']);
        
    }

    /**
     * Finds the PeriodosAfastamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PeriodosAfastamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PeriodosAfastamento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
