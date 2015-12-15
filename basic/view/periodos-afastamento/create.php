<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamento */

$this->title = 'Create Periodos Afastamento';
$this->params['breadcrumbs'][] = ['label' => 'Periodos Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-afastamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
