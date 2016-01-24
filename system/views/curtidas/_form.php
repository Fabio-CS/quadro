<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\Curtidas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="curtidas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->dropdownList(
            ArrayHelper::map(Usuarios::find()->where(['ativo' => 1])->orderBy('nome_completo')->all(), 'id_usuario', 'nome_completo'), ['prompt'=>'Selecione o usuário']); ?>

    <?= $form->field($model, 'motivo')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
