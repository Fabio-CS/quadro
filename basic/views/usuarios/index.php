<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TiposUsuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Usuários', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
               'attribute' => 'id_usuario',
               'contentOptions' => ['style' => 'width: 50px;', 'class' => 'text-center'], 
            ],
            'num_matricula',
            'nome_completo',
            'funcao',
            'setor',
            [
                'attribute' => 'tipoUsuario.nome',
                'label' => 'Tipo de usuário'
	    ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 80px; text-align: center']
            ],
        ],
    ]); ?>

</div>
