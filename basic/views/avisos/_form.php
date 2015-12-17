<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagem')->fileInput() ?>

    <?= $form->field($model, 'tempo_exibicao')->textInput() ?>

    <?= $form->field($model, 'data_inicio')->input("date") ?>

    <?= $form->field($model, 'data_fim')->input("date") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
