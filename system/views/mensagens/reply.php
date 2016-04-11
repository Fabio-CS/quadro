<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mensagens */

$this->title = 'Responder Mensagem: ' . ' ' . $model->assunto;
$this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->assunto, 'url' => ['view', 'id' => $model->id_mensagem]];
$this->params['breadcrumbs'][] = 'Responder';
$model->scenario = "resposta";
?>
<div class="mensagens-responder">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
