<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

$this->title = $model->id_aviso;
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
            'imagem',
            'tempo_exibicao',
            'data_inicio',
            'data_fim',
            'criado_por',
            'criado_em',
            'modificado_por',
            'modificado_em',
            'ativo',
        ],
    ]) ?>

</div>
