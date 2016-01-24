<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionaisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estados-emocionais-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_estado_emocional') ?>

    <?= $form->field($model, 'tipo_estado_emocional') ?>

    <?= $form->field($model, 'usuario') ?>
    
    <?= $form->field($model, 'motivo') ?>

    <?= $form->field($model, 'data') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
