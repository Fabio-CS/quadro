<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeriodosAfastamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Períodos de Afastamentos';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-afastamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Inserir Períodos de Afastamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'usuario.nome_completo',
                'label' => 'Colaborador'
            ],
            [
                'attribute' => 'tipoAfastamento.nome',
                'label' => 'Tipo de Afastamento'
            ],
            [
                'attribute' => 'data_inicio',
                'format' => ['date', 'dd/MM/Y'],
            ],
            [
                'attribute' => 'data_fim',
                'format' => ['date', 'dd/MM/Y'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
