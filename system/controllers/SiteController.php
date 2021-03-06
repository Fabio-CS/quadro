<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Usuarios;
use app\models\Avisos;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['menu-admin', 'menu-colaborador', 'menu-developer', 'index'],
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $avisos = Avisos::getActiveAvisos();
        $usuarios = Usuarios::find()->innerJoinWith('tipoUsuario')->where(["usuarios.ativo" => 1])->andWhere([ 'not', ["tipos_usuario.nome" => Yii::$app->params['Dev']]])->andWhere([ 'not', ["tipos_usuario.nome" => Yii::$app->params['Mural']]])->andWhere([ 'not', ["tipos_usuario.nome" => Yii::$app->params['Tablet']]])->orderBy(['nome_completo' => 'SORT_ASC'])->all();
        return $this->render('index', ['usuarios' => $usuarios, 'avisos' => $avisos]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }
    
    public function actionMenuAdmin()
    {
        return $this->render('menu-admin');
    }
    
    public function actionMenuColaborador()
    {
        return $this->render('menu-colaborador');
    }
    
    public function actionMenuDeveloper()
    {
        return $this->render('menu-developer');
    }
    
    public function actionMural()
    {
        return $this->render('index');
    }
}
