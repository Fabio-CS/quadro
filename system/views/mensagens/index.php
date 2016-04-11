<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensagensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensagens-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
      
    ?>
    <p>
        <?= Html::a('Enviar Mensagens', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Mensagens Enviadas', ['sent'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Grupo de Mensagens', ['/grupo-usuarios/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <h2>Mensagens Recebidas</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Enviada em',
                'attribute' => 'criado_em',
                'format' => ['date', 'dd/MM/Y - H:mm:ss'],
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
                'label' => 'Remetente',
                'attribute' => 'remetente.nome_completo'
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

</div>
