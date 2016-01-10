<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvisosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avisos';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
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
                'format' => ['image',['height'=>'300']],
                'value' => 'imageUrl',
                'filter' => false
	    ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
