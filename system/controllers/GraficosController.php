<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\EstadosEmocionais;
use app\models\Configuracoes;

class GraficosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['menu-admin', 'menu-colaborador', 'menu-developer'],
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
        return $this->render('index');
    }

    public function actionMensal($ano)
    {
        $meta = Configuracoes::findOne(1);
        $grafico = EstadosEmocionais::getGraficoMensalData($ano);
        return $this->render('mensal', ['grafico' => $grafico, 'ano' => $ano, 'meta' => $meta->valor]);
    }
    
    public function actionMes($mes, $ano)
    {
        $meta = Configuracoes::findOne(1);
        $grafico = EstadosEmocionais::getGraficoMesData($mes, $ano);
        return $this->render('mes', ['grafico' => $grafico, 'mes' => $mes, 'ano' => $ano, 'meta' => $meta->valor]);
    }
    
    public function actionAno($ano)
    {
        $meta = Configuracoes::findOne(1);
        $grafico = EstadosEmocionais::getGraficoAnoData($ano);
        return $this->render('ano', ['grafico' => $grafico, 'ano' => $ano, 'meta' => $meta->valor]);
    }

}
