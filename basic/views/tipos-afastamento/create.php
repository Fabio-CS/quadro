<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposAfastamento */

$this->title = 'Create Tipos Afastamento';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-afastamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
