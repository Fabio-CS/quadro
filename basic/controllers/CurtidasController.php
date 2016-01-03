<?php

namespace app\controllers;

use Yii;
use app\models\Curtidas;
use app\models\CurtidasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CurtidasController implements the CRUD actions for Curtidas model.
 */
class CurtidasController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'index', 'create', 'delete', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Curtidas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CurtidasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Curtidas model.
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
     * Creates a new Curtidas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Curtidas();

        if ($model->load(Yii::$app->request->post())) {
            $model->criado_por = Yii::$app->user->getId();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_curtida]);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Curtidas model.
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
                return $this->redirect(['view', 'id' => $model->id_curtida]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Curtidas model.
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
        Yii::$app->session->setFlash('error', 'Erro ao deletar curtida');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Curtidas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Curtidas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Curtidas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
