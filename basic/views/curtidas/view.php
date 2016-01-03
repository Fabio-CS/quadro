<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curtidas */

$this->title = "Detalhes da Curtida";
$this->params['breadcrumbs'][] = ['label' => 'Curtidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curtidas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_curtida], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_curtida], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você está certo que quer excluir esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_curtida',
            [
                'attribute' => 'usuarioO.nome_completo',
                'label' => 'Usuário'
	    ],
            'motivo',
            [
                'attribute' => 'criado_em',
                'format' => ['date', 'dd/MM/Y'],
            ],
        ],
    ]) ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
