<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */

$this->title = 'Update Estados Emocionais: ' . ' ' . $model->id_estado_emocional;
$this->params['breadcrumbs'][] = ['label' => 'Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_estado_emocional, 'url' => ['view', 'id' => $model->id_estado_emocional]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estados-emocionais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
