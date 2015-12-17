<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvisosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avisos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Avisos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_aviso',
            'titulo',
            'descricao',
            'imagem',
            'tempo_exibicao',
            'data_inicio',
            'data_fim',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
