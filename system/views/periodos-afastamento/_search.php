<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodos-afastamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_periodo_afastamento') ?>

    <?= $form->field($model, 'usuario') ?>

    <?= $form->field($model, 'tipo_afastamento') ?>

    <?= $form->field($model, 'data_inicio') ?>

    <?= $form->field($model, 'data_fim') ?>

    <?php // echo $form->field($model, 'criado_por') ?>

    <?php // echo $form->field($model, 'criado_em') ?>

    <?php // echo $form->field($model, 'modificado_por') ?>

    <?php // echo $form->field($model, 'modificado_em') ?>

    <?php // echo $form->field($model, 'ativo') ?>

    <div class="form-group">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
