<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estados-emocionais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_estado_emocional')->textInput() ?>

    <?= $form->field($model, 'usuario')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'criado_por')->textInput() ?>

    <?= $form->field($model, 'criado_em')->textInput() ?>

    <?= $form->field($model, 'modificado_por')->textInput() ?>

    <?= $form->field($model, 'modificado_em')->textInput() ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
