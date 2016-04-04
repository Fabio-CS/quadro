<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */

$this->title = $model->usuario->nome_completo;
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
    $this->params['breadcrumbs'][] = ['label' => 'Humor', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->id_estado_emocional, 'url' => ['view', 'id' => $model->id_estado_emocional]];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
    $this->params['breadcrumbs'][] = 'Humor';
}
?>
<div class="estados-emocionais-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_estado_emocional], ['class' => 'btn btn-primary']) ?>
        <?php if(! Yii::$app->user->identity->isColab()) { ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_estado_emocional], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você está certo que quer excluir esse item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
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
                'attribute' => 'usuario.nome_completo',
                'label' => 'Colaborador'
            ],
            [
                'attribute' => 'motivo'
            ],
            [
                'attribute' => 'data',
                'format' => ['date', 'dd/MM/Y'],
            ]
        ],
    ]) ?>
    <p>
        <?php if(Yii::$app->user->identity->isColab()) {?>
        <?= Html::a('Voltar', ['site/menu-colaborador'], ['class' => 'btn btn-primary']) ?>
        <?php }else { ?>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>    
        <?php } ?>
    </p>
</div>
