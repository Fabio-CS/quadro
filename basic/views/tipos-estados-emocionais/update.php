<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TiposEstadosEmocionais */

$this->title = 'Atualizar Tipo de Estado Emocional: ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id_tipo_estado_emocional]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipos-estados-emocionais-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
