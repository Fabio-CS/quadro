<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Mensagens */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensagens-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        if($model->scenario == 'enviar') {
    ?>
    <?= $form->field($model, 'id_destinatario')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Usuarios::find()->where(['ativo' => 1])->orderBy('nome_completo')->all(), 'id_usuario', 'nome_completo'),
    'options' => ['placeholder' => 'Selecione os destinatários...'],
    'pluginOptions' => [
        'allowClear' => true,
        'multiple' => true
    ],
    ]); ?>
    
    <?= $form->field($model, 'assunto')->textInput(['maxlength' => true]) ?>
    
    <?php } ?>
    
    <?php
        if($model->scenario == 'resposta') {
    ?>
    
    <?= $form->field($model, 'id_destinatario')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Usuarios::find()->where(['ativo' => 1])->orderBy('nome_completo')->all(), 'id_usuario', 'nome_completo'),
    'options' => ['placeholder' => 'Selecione os destinatários...'],
    'pluginOptions' => [
        'allowClear' => false,
        'multiple' => true,
        'disabled' => true
    ],
    ]); ?>
    
    <?= $form->field($model, 'assunto')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    
    <?php } ?>
    
    <?= $form->field($model, 'texto')->textarea(['maxlength' => true]) ?>
    <?php
        if($model->scenario == 'resposta') {
    ?>
    <?= $form->field($model, 'resposta_de')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'id_destinatario')->hiddenInput()->label(false); ?>
    <?php } ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
