<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuarios */

$this->title = $model->id_grupo_usuarios;
$this->params['breadcrumbs'][] = ['label' => 'Grupo Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_grupo_usuarios], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_grupo_usuarios], [
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
            'id_grupo_usuarios',
            'nome',
            'descricao',
            'criado_por',
            'criado_em',
            'modificado_por',
            'modificado_em',
            'ativo',
        ],
    ]) ?>

</div>
