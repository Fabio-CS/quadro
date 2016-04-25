<?php

namespace app\controllers;

use Yii;
use app\models\GrupoUsuarios;
use app\models\GrupoUsuariosSearch;
use app\models\Usuarios;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * GrupoUsuariosController implements the CRUD actions for GrupoUsuarios model.
 */
class GrupoUsuariosController extends Controller
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
     * Lists all GrupoUsuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GrupoUsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GrupoUsuarios model.
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
     * Creates a new GrupoUsuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GrupoUsuarios();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->criado_por = Yii::$app->user->getId();
            if ($model->save()) {
                return $this->redirect(['index']);
            }else {
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
     * Updates an existing GrupoUsuarios model.
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
                return $this->redirect(['index']);
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
     * Updates an existing GrupoUsuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

            if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post('GrupoUsuarios');
            $usuarios = [];
            foreach($request['usuarios'] as $usuario){
                $usuarios[] = Usuarios::findOne($usuario);
            }
            $model->linkAll('usuarios', $usuarios, [], true, true);
            $model->modificado_por = Yii::$app->user->getId();
            $model->modificado_em = date('Y-m-d G:i:s');
            if($model->save()){
                return $this->redirect(['index']);
            }else{
                return $this->render(['include', 'model' => $model]);
            }
        } else {
            return $this->render('include', [
                'model' => $model,
            ]);
        }
    }
    

    /**
     * Deletes an existing GrupoUsuarios model.
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
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao deletar grupo de usuários');
            return $this->render(['index']);
        }
    }

    /**
     * Finds the GrupoUsuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GrupoUsuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GrupoUsuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
