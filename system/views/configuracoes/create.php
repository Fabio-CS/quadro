<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Configuracoes */

    $this->title = 'Criar Configuração';

    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
    $this->params['breadcrumbs'][] = ['label' => 'Gráficos', 'url' => ['graficos/index']];

    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuracoes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
