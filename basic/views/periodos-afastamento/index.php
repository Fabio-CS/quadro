<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodosAfastamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Periodos Afastamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-afastamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Periodos Afastamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_periodo_afastamento',
            'usuario',
            'tipo_afastamento',
            'data_inicio',
            'data_fim',
            // 'criado_por',
            // 'criado_em',
            // 'modificado_por',
            // 'modificado_em',
            // 'ativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>