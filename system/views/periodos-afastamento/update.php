<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamento */

$this->title = 'Atualizar Períodos de Afastamento: ' . ' ' . $model->id_periodo_afastamento;
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
$this->params['breadcrumbs'][] = ['label' => 'Períodos de Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_periodo_afastamento, 'url' => ['view', 'id' => $model->id_periodo_afastamento]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="periodos-afastamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
