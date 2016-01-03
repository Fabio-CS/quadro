<?php

namespace app\controllers;

use Yii;
use app\models\TiposEstadosEmocionais;
use app\models\TiposEstadosEmocionaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TiposEstadosEmocionaisController implements the CRUD actions for TiposEstadosEmocionais model.
 */
class TiposEstadosEmocionaisController extends Controller
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
     * Lists all TiposEstadosEmocionais models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TiposEstadosEmocionaisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TiposEstadosEmocionais model.
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
     * Creates a new TiposEstadosEmocionais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TiposEstadosEmocionais();
        $model->scenario = "create";
        
        if ($model->load(Yii::$app->request->post())) {
            $image = $model->uploadImage();
            
            if($model->save() && $image !== false){
                    // upload only if valid uploaded file instance found
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                    return $this->redirect(['view', 'id' => $model->id_tipo_estado_emocional]);
                }
                //error saving model
                return $this->render('create', ['model' => $model,]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing TiposEstadosEmocionais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = "update";
        $oldFile = $model->getImageFile();
        $oldFoto = $model->icone;
        
        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();
            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->icone = $oldFoto;
            }
            if ($model->save()) {
                if ($image !== false && unlink($oldFile)) {
                    // upload only if valid uploaded file instance found
                    // delete old and overwrite
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->id_tipo_estado_emocional]);
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
     * Deletes an existing TiposEstadosEmocionais model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        unlink($model->getImageFile());
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the TiposEstadosEmocionais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TiposEstadosEmocionais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TiposEstadosEmocionais::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
