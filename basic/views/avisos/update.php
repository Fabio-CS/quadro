<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

$this->title = 'Atualizar Aviso: ' . ' ' . $model->titulo;
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->titulo, 'url' => ['view', 'id' => $model->id_aviso]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="avisos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
