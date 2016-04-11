<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mensagens */

$this->title = $model->assunto;
$this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensagens-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'assunto',
            'texto',
            [
                'label' => 'Destinatário',
                'attribute' => 'destinatario.nome_completo'
            ],
            [
                'label' => 'Lida',
                'format' => 'raw',
                'value' => $model->getDisplayLida()
            ],
            [
                'label' => 'Resposta de',
                'format' => 'raw',
                'value' => $model->getOriginalLink()
	    ],
            [
                'label' => 'Remetente',
                'attribute' => 'remetente.nome_completo'
	    ],
            [
                'label' => 'Enviada em',
                'attribute' => 'criado_em',
                'format' => ['date', 'dd/MM/Y - H:mm:ss'],
	    ],
            [
                'label' => 'Responder',
                'format' => 'raw',
                'value' => $model->getResponderLink()
            ]
        ],
    ]) ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
