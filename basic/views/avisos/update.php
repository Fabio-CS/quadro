<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */

$this->title = 'Update Avisos: ' . ' ' . $model->id_aviso;
$this->params['breadcrumbs'][] = ['label' => 'Avisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_aviso, 'url' => ['view', 'id' => $model->id_aviso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avisos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
