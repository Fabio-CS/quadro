<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curtidas */

$this->title = $model->id_curtida;
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
            'usuario',
            'motivo',
            'criado_por',
            'criado_em',
            'modificado_por',
            'modificado_em',
            'ativo',
        ],
    ]) ?>

</div>
