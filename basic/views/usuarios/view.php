<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\TiposUsuario;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = $model->nome_completo;
$this->params['breadcrumbs'][] = ['label' => 'Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_usuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você tem certeza que deseja excluir este usuário?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_usuario',
            'num_matricula',
            'nome_completo',
            'email:email',
            'funcao',
            'setor',
            [
                'attribute' => 'data_nasc',
                'format' => ['date', 'dd/MM/Y'],
            ],
            [
                'attribute' => 'tipoUsuario.nome',
                'label' => 'Tipo de usuário',
	    ],
            [
                'attribute' =>'photo',
                'value' => Yii::$app->params['uploadPath'].$model->foto,
                'format' => ['image',['width'=>'200','height'=>'300']],
            ],
        ],
    ]) ?>

</div>
