<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TiposAfastamento */

$this->title = 'Update Tipos Afastamento: ' . ' ' . $model->id_tipo_afastamento;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_afastamento, 'url' => ['view', 'id' => $model->id_tipo_afastamento]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipos-afastamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
