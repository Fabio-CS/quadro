<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposUsuario */

$this->title = 'Criar Tipo de Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
