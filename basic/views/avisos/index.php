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
        <?= Html::a('Criar Aviso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_aviso',
            'titulo',
            'descricao',
            'tempo_exibicao',
            'data_inicio',
            'data_fim',
            [
                'attribute' =>'imagem',
                'format' => ['image',['width'=>'200','height'=>'300']],
                'value' => 'imageUrl',
                'filter' => false
	    ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
