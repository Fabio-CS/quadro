<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TiposUsuario;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_nasc')->input("date") ?>

    <?= $form->field($model, 'funcao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'setor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->fileInput() ?>

    <?= $form->field($model, 'email')->input("email") ?>

    <?= $form->field($model, 'senha')->passwordInput() ?>
    
    <?= $form->field($model, 'confirmsenha')->passwordInput() ?>

    <?= $form->field($model, 'tipo_usuario')->dropdownList(
            TiposUsuario::find()->select(['nome', 'id'])->indexBy('nome')->column(), ['prompt'=>'Selecione o tipo de usuário']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
