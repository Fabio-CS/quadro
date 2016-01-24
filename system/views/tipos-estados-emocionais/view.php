<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TiposEstadosEmocionais */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-estados-emocionais-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_tipo_estado_emocional], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_tipo_estado_emocional], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que quer deletar esse item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_tipo_estado_emocional',
            'nome',
            [
                'attribute' => 'privado',
                'value' => $model->privado ? "Privado" : "Público"
            ],
            [
                'attribute' =>'icone',
                'value' => $model->getImageUrl(),
                'format' => ['image',['width'=>'200','height'=>'200']],
            ]
        ],
    ]) ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
