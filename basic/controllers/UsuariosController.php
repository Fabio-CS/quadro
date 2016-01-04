<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use app\models\LoginForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'index', 'create', 'delete', 'update', 'logout'],
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
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
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
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios();
        $model->scenario = 'create';
        
        if ($model->load(Yii::$app->request->post())) {
                // process uploaded image file instance
                $image = $model->uploadImage();
                $model->criado_por = Yii::$app->user->getId();
                if($model->save()){
                    // upload only if valid uploaded file instance found
                    if($image !== false){
                        $path = $model->getImageFile();
                        $image->saveAs($path);
                    }
                    return $this->redirect(['view', 'id' => $model->id_usuario]);
                }
                //error saving model
                return $this->render('create', ['model' => $model,]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $oldFile = $model->getImageFile();
        $oldFoto = $model->foto;
        
        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();
            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->foto = $oldFoto;
            }
            $model->modificado_por = Yii::$app->user->getId();
            $model->modificado_em = date('Y-m-d G:i:s');
            if ($model->save()) {
                if ($image !== false && unlink($oldFile)) {
                    // upload only if valid uploaded file instance found
                    // delete old and overwrite
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->id_usuario]);
            } else {
                // error in saving model
               return $this->render('update', [
                'model'=>$model,
               ]); 
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Deletes an existing Usuarios model.
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
            Yii::$app->session->setFlash('error', 'Erro ao deletar usuário');
            return $this->render(['index']);
        }
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * Processo de Login
     */
    public function actionLogin()
    {

        $model = new LoginForm();
        $model->scenario = "web";
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Yii::$app->user->identity->getMenu());
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Processo de Login
     */
    public function actionLocal()
    {

        $model = new LoginForm();
        $model->scenario = "local";
        if ($model->load(Yii::$app->request->post()) && ($model->validate())) {
            $model->login();
            return $this->redirect(["estados-emocionais/checkin"]);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     *  Processo de Logout
     * @return Index page
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
