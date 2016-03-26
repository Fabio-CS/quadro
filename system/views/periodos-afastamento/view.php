<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamento */

$this->title = $model->usuario->nome_completo;
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
$this->params['breadcrumbs'][] = ['label' => 'Períodos de Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-afastamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_periodo_afastamento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_periodo_afastamento], [
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
            'id_periodo_afastamento',
            [
                'attribute' => 'usuario.nome_completo',
                'label' => 'Colaborador'
            ],
            [
                'attribute' => 'tipoAfastamento.nome',
                'label' => 'Tipo de Afastamento'
            ],
            [
                'attribute' => 'data_inicio',
                'format' => ['date', 'dd/MM/Y'],
            ],
            [
                'attribute' => 'data_fim',
                'format' => ['date', 'dd/MM/Y'],
            ],
        ],
    ]) ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
