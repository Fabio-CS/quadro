<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiposUsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Usuários';
if (Yii::$app->user->identity->isDev()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Desenvolvedor', 'url' => Url::toRoute(['site/menu-developer'])];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Tipos de Usuários', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_tipo_usuario',
            'nome',
            'descricao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
