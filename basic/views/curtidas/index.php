<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurtidasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Curtidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curtidas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Enviar Curtidas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id_curtida',
            'usuarioO.nome_completo',
            'motivo',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
