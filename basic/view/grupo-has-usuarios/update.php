<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoHasUsuarios */

$this->title = 'Update Grupo Has Usuarios: ' . ' ' . $model->id_grupo_usuarios;
$this->params['breadcrumbs'][] = ['label' => 'Grupo Has Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_grupo_usuarios, 'url' => ['view', 'id_grupo_usuarios' => $model->id_grupo_usuarios, 'id_usuario' => $model->id_usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grupo-has-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
