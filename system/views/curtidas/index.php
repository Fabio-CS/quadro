<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurtidasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Curtidas';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
} else if (Yii::$app->user->identity->isDev()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Developer', 'url' => Url::toRoute(['site/menu-developer'])];
}
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
        'columns' => [
            'id_curtida',
            'usuario.nome_completo',
            'motivo',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
