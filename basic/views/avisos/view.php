<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avisos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_aviso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_aviso], [
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
            'id_aviso',
            'titulo',
            'descricao',
            'tempo_exibicao',
            [
                'attribute' => 'data_inicio',
                'format' => ['date', 'dd/MM/Y'],
            ],
            [
                'attribute' => 'data_fim',
                'format' => ['date', 'dd/MM/Y'],
            ],
            [
                'attribute' =>'imagem',
                'value' => $model->getImageUrl(),
                'format' => ['image',['width'=>'600','height'=>'800']],
            ]
        ],
    ]) ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>

