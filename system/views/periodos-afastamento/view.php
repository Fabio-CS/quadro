<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamento */

$this->title = $model->id_periodo_afastamento;
$this->params['breadcrumbs'][] = ['label' => 'Periodos Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-afastamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_periodo_afastamento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_periodo_afastamento], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_periodo_afastamento',
            'usuario',
            'tipo_afastamento',
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
