<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mensagens */

$this->title = 'Update Mensagens: ' . ' ' . $model->id_mensagem;
$this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_mensagem, 'url' => ['view', 'id' => $model->id_mensagem]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mensagens-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
