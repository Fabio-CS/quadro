<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuarios */

$this->title = 'Atualizar Grupo de Usuários: ' . ' ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Grupo de Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Atualizar';

?>
<div class="grupo-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
