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
            ['class' => 'yii\grid\SerialColumn'],

            'id_usuario',
            'num_matricula',
            'nome_completo',
            //'data_nasc',
            'funcao',
            'setor',
            // 'foto',
            'email:email',
            // 'senha',
            'tipo_usuario',
            [
                'attribute' => 'tipo_usuario',
                'type' => 'html',
                'value' => function($model) {
                        $tipoUsuario = TiposUsuario::findModel($model->tipo_usuario);
                        return $tipoUsuario->nome;
                }
	    ],
            // 'ativo',
            // 'criado_por',
            // 'criado_em',
            // 'modificado_por',
            // 'modificado_em',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
