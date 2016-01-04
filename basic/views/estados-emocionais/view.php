<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */

$this->title = $model->id_estado_emocional;
$this->params['breadcrumbs'][] = ['label' => 'Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-emocionais-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_estado_emocional], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_estado_emocional], [
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
            'id_estado_emocional',
            [
               'attribute' => 'tipoEstadoEmocional.nome',
                'label' => 'Estado Emocional'
            ],
            [
                'attribute' => 'usuarioO.nome_completo',
                'label' => 'Colaborador'
            ],
            [
                'attribute' => 'data',
                'format' => ['date', 'dd/MM/Y'],
            ]
        ],
    ]) ?>

</div>
