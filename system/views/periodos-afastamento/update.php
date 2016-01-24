<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamento */

$this->title = 'Update Periodos Afastamento: ' . ' ' . $model->id_periodo_afastamento;
$this->params['breadcrumbs'][] = ['label' => 'Periodos Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_periodo_afastamento, 'url' => ['view', 'id' => $model->id_periodo_afastamento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="periodos-afastamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
