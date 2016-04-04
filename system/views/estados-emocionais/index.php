<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EstadosEmocionaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Humores';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-emocionais-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Sugerir Humor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_estado_emocional',
            [
               'attribute' => 'tipoEstadoEmocional.nome',
                'label' => 'Humor'
            ],
            [
                'attribute' => 'usuario.nome_completo',
                'label' => 'Colaborador'
            ],
            [
               'attribute' => 'motivo'
            ],
            [
                'attribute' => 'data',
                'format' => ['date', 'dd/MM/Y'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
