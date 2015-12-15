<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Curtidas */

$this->title = 'Update Curtidas: ' . ' ' . $model->id_curtida;
$this->params['breadcrumbs'][] = ['label' => 'Curtidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_curtida, 'url' => ['view', 'id' => $model->id_curtida]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curtidas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
