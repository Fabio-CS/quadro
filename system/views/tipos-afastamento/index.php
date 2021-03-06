<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiposAfastamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos Afastamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-afastamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipos Afastamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_tipo_afastamento',
            'nome',
            'ativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
