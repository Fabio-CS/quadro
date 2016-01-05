<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\TiposEstadosEmocionais;
use app\models\EstadosEmocionais;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadosEmocionaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Administrador';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-menu-admin">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

    <p>
        Aqui vai os links para as funcionalidades.
    </p>
    <?php
        $tipo_estado_emocional_ruim = TiposEstadosEmocionais::find()->select('id_tipo_estado_emocional')->where(['nome' => Yii::$app->params['estadosRuins']])->all();
        $ids = [];
        foreach ($tipo_estado_emocional_ruim as $key => $value) {
           $ids[] = $value->id_tipo_estado_emocional;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => EstadosEmocionais::find()->where(['tipo_estado_emocional' => $ids, 'motivo' => ""]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
               'attribute' => 'tipoEstadoEmocional',
               'label' => 'Estado Emocional',
               'value' => 'tipoEstadoEmocional.imageUrl',
               'format' => ['image', ['width'=>'50','height'=>'50']],
            ],
            /*[
               'attribute' => 'tipoEstadoEmocional.nome',
               'label' => 'Estado Emocional'
            ],*/
            [
                'attribute' => 'usuarioO.nome_completo',
                'label' => 'Colaborador'
            ],
            [
                'attribute' => 'usuarioO.setor',
                'label' => 'Setor'
            ],
            [
               'attribute' => 'motivo'
            ],
            [
                'attribute' => 'data',
                'format' => ['date', 'dd/MM/Y'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Resolver',
                'template' => '{update}',
                'controller' => 'estados-emocionais'
            ],
        ],
    ]); ?>

</div>
