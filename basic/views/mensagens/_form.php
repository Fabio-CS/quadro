<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mensagens */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensagens-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'texto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destinatario')->textInput() ?>

    <?= $form->field($model, 'lida')->textInput() ?>

    <?= $form->field($model, 'resposta_de')->textInput() ?>

    <?= $form->field($model, 'criado_por')->textInput() ?>

    <?= $form->field($model, 'criado_em')->textInput() ?>

    <?= $form->field($model, 'ativo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
