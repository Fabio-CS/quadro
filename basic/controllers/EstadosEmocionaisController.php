<?php

namespace app\controllers;

use Yii;
use app\models\EstadosEmocionais;
use app\models\EstadosEmocionaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstadosEmocionaisController implements the CRUD actions for EstadosEmocionais model.
 */
class EstadosEmocionaisController extends Controller
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
     * Lists all EstadosEmocionais models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstadosEmocionaisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EstadosEmocionais model.
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
     * Creates a new EstadosEmocionais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EstadosEmocionais();

        if ($model->load(Yii::$app->request->post())) {
            $model->data = date('Y-m-d');
            $model->criado_por = Yii::$app->user->getId();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_estado_emocional]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EstadosEmocionais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * ########### VVVVVVVVVVVV COISAS A FAZER ######## VVVVVVVVVV
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_estado_emocional]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EstadosEmocionais model.
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
     * Lists all EstadosEmocionais models.
     * @return mixed
     */
    public function actionCheckin()
    {
        $model = new EstadosEmocionais();

        if (Yii::$app->request->post()) {
            $model->tipo_estado_emocional = Yii::$app->request->get("tipo_estado_emocional");
            $model->usuario = Yii::$app->user->getId();
            $model->motivo = "";
            $model->data = date('Y-m-d');
            $model->criado_por = Yii::$app->user->getId();
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Check-in de estado emocional realizado com sucesso!');
                Yii::$app->user->logout();
                return $this->redirect(['usuarios/local', 'msg' => '1']);
            }
            Yii::$app->session->setFlash('error', 'Erro ao realizar o check-in');
            $this->redirect(['usuarios/local']);
        } 
        return $this->render('checkin', [
                'model' => $model,
        ]);
    }
    
    /**
     * Finds the EstadosEmocionais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EstadosEmocionais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EstadosEmocionais::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
