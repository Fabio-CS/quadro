<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TiposUsuario */

$this->title = 'Update Tipos Usuario: ' . ' ' . $model->id_tipo_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_usuario, 'url' => ['view', 'id' => $model->id_tipo_usuario]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="tipos-usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
