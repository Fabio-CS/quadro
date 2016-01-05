<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Usuarios;
use app\models\TiposEstadosEmocionais;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estados-emocionais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_estado_emocional')->dropdownList(
            ArrayHelper::map(TiposEstadosEmocionais::find()->where(['privado' => 0, 'ativo' => 1])->orderBy('nome')->all(), 'id_tipo_estado_emocional', 'nome'), ['prompt'=>'Selecione o tipo de estado emocional']); ?>

    <?= $form->field($model, 'usuario')->dropdownList(
            ArrayHelper::map(Usuarios::find()->where(['ativo' => 1])->orderBy('nome_completo')->all(), 'id_usuario', 'nome_completo'), ['prompt'=>'Selecione o usuário']); ?>
    
    <?= $form->field($model, 'motivo')->textarea(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Inserir' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
