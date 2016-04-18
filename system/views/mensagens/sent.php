<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensagensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensagens Enviadas';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
}
$this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensagens-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Enviada em',
                'format' => 'raw',
                'value' => function ($data) {
                        return $data->getDisplayEnviada();
                      },
	    ],
            [
                'label' => 'Assunto',
                'format' => 'raw',
                'value' => function ($data) {
                        return Html::a($data->assunto, ['view', 'id' => $data->id_mensagem]);
                      },
            ],
            [
                'label' => 'Mensagem',
                'format' => 'raw',
                'value' => function ($data) {
                        return $data->GetTruncatedMensagemText();
                      },
            ],
            [
                'label' => 'Destinatario',
                'attribute' => 'destinatario.nome_completo'
	    ],
            [
                'label' => 'Lida',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->getDisplayLida();
                }
            ],
            [
                'label' => 'Resposta de',
                'format' => 'raw',
                'value' => function ($data) {
                        return Html::a($data->respostaDe->assunto, ['view', 'id' => $data->respostaDe->id_mensagem]);
                      },
	    ],
            [
                'label' => 'Responder',
                'format' => 'raw',
                'value' => function ($data) {
                        return Html::a('Responder', ['reply', 'id' => $data->id_mensagem]);
                      },
            ]
        ],
    ]); ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
