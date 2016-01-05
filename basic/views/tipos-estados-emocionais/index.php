<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiposEstadosEmocionaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Estados Emocionais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-estados-emocionais-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Tipo de Estado Emocional', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id_tipo_estado_emocional',
            'nome',
            [
                'attribute' => 'privado',
                'value' => function ($data){
                    return $data->privado ? "Privado" : "Público";
                }
            ],
            [
                'attribute' =>'icone',
                'format' => ['image',['width'=>'50','height'=>'50']],
                'value' => 'imageUrl',
                'filter' => false
	    ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
