<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuarios */

$this->title = 'Update Grupo Usuarios: ' . ' ' . $model->id_grupo_usuarios;
$this->params['breadcrumbs'][] = ['label' => 'Grupo Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_grupo_usuarios, 'url' => ['view', 'id' => $model->id_grupo_usuarios]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grupo-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
