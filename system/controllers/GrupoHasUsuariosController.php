<?php

namespace app\controllers;

use Yii;
use app\models\GrupoHasUsuarios;
use app\models\GrupoHasUsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GrupoHasUsuariosController implements the CRUD actions for GrupoHasUsuarios model.
 */
class GrupoHasUsuariosController extends Controller
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
     * Lists all GrupoHasUsuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrupoHasUsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GrupoHasUsuarios model.
     * @param integer $id_grupo_usuarios
     * @param integer $id_usuario
     * @return mixed
     */
    public function actionView($id_grupo_usuarios, $id_usuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_grupo_usuarios, $id_usuario),
        ]);
    }

    /**
     * Creates a new GrupoHasUsuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GrupoHasUsuarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_grupo_usuarios' => $model->id_grupo_usuarios, 'id_usuario' => $model->id_usuario]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GrupoHasUsuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_grupo_usuarios
     * @param integer $id_usuario
     * @return mixed
     */
    public function actionUpdate($id_grupo_usuarios, $id_usuario)
    {
        $model = $this->findModel($id_grupo_usuarios, $id_usuario);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_grupo_usuarios' => $model->id_grupo_usuarios, 'id_usuario' => $model->id_usuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GrupoHasUsuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_grupo_usuarios
     * @param integer $id_usuario
     * @return mixed
     */
    public function actionDelete($id_grupo_usuarios, $id_usuario)
    {
        $this->findModel($id_grupo_usuarios, $id_usuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GrupoHasUsuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_grupo_usuarios
     * @param integer $id_usuario
     * @return GrupoHasUsuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_grupo_usuarios, $id_usuario)
    {
        if (($model = GrupoHasUsuarios::findOne(['id_grupo_usuarios' => $id_grupo_usuarios, 'id_usuario' => $id_usuario])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
