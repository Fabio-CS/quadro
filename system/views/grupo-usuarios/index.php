<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrupoUsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupo Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Grupo Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_grupo_usuarios',
            'nome',
            'descricao',
            'criado_por',
            'criado_em',
            // 'modificado_por',
            // 'modificado_em',
            // 'ativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
