<?php

namespace app\controllers;

use Yii;
use app\models\Mensagens;
use app\models\MensagensSearch;
use app\models\MensagensSentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\GrupoUsuarios;

/**
 * MensagensController implements the CRUD actions for Mensagens model.
 */
class MensagensController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'read' => ['post']
                ],
            ],
        ];
    }

    /**
     * Lists all Mensagens models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MensagensSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Mensagens enviadas models.
     * @return mixed
     */
    public function actionSent()
    {
        $searchModel = new MensagensSentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('sent', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mensagens model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(!$model->isLida()){
            if($model->id_destinatario == Yii::$app->user->id){
                $model->lida = date('Y-m-d G:i:s');
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'Mensagem marcada como lida com sucesso!');
                }else{
                    Yii::$app->session->setFlash('error', 'Erro ao marcar mensagem como lida!');
                }
            }
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Mensagens model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mensagens();

        if ($model->load(Yii::$app->request->post())) {
            $model->criado_por = Yii::$app->user->getId();
            
            $receivers = $model->id_destinatario;
            if(count($receivers)>1){
                    foreach($receivers as $destinatario){
                            $model2 = new Mensagens();
                            $model2->attributes = $model->attributes;
                            $model2->id_destinatario = $destinatario;
                            $model2->criado_por = Yii::$app->user->getId();
                            $model2->ativo = 1;
                            $model2->save();
                    }
                return $this->redirect(['sent']);
            }else{
                $model->id_destinatario = $model->id_destinatario[0];
                if ($model->save()){

                }
            }
            return $this->redirect(['view', 'id' => $model->id_mensagem]);
        } else {
            $model->scenario = "enviar";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Mensagens model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGroup()
    {
        $model = new Mensagens();

        if ($model->load(Yii::$app->request->post())) {
            $model->criado_por = Yii::$app->user->getId();
            $group = GrupoUsuarios::findOne($model->id_destinatario);
            $receivers = $group->usuarios;
            foreach($receivers as $destinatario){
                    $model2 = new Mensagens();
                    $model2->attributes = $model->attributes;
                    $model2->id_destinatario = $destinatario->id_usuario;
                    $model2->criado_por = Yii::$app->user->getId();
                    $model2->ativo = 1;
                    $model2->save();
            }
                return $this->redirect(['sent']);   
        } else {
            $model->scenario = "group";
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Reply an existing Mensagens model.
     * If reply is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionReply($id)
    {   
        $original = $this->findModel($id);
        $model = new Mensagens();
        $model->assunto = $original->assunto;
        $model->resposta_de = $original->id_mensagem;
        $model->id_destinatario = $original->criado_por;
        $model->criado_por = Yii::$app->user->getId();
        
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_mensagem]);
        } else {
            return $this->render('reply', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mensagens model.
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
     * Reads an existing Mensagens model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRead($id)
    {
        $model = $this->findModel($id);
        $model->lida = date('Y-m-d G:i:s');
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Mensagem marcada como lida com sucesso!');
        }else{
            Yii::$app->session->setFlash('error', 'Erro ao marcar mensagem como lida!');
        }
        $searchModel = new MensagensSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Reads an existing Mensagens model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionReadCheckin($id)
    {
        $model = $this->findModel($id);
        $model->lida = date('Y-m-d G:i:s');
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Mensagem marcada como lida com sucesso!');
        }else{
            Yii::$app->session->setFlash('error', 'Erro ao marcar mensagem como lida!');
        }
        return $this->redirect(["estados-emocionais/checkin"]);
    }

    /**
     * Finds the Mensagens model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mensagens the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensagens::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
