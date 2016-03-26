<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;
use app\models\TiposEstadosEmocionais;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="periodos-afastamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_usuario')->dropdownList(
            ArrayHelper::map(Usuarios::find()->where(['ativo' => 1])->orderBy('nome_completo')->all(), 'id_usuario', 'nome_completo'), ['prompt'=>'Selecione o usuário']); ?>

    <?= $form->field($model, 'id_tipo_afastamento')->dropdownList(
            ArrayHelper::map(TiposEstadosEmocionais::find()->where(['privado' => 1, 'ativo' => 1])->orderBy('nome')->all(), 'id_tipo_estado_emocional', 'nome'), ['prompt'=>'Selecione o tipo de estado emocional']); ?>

    <?= $form->field($model, 'data_inicio')->input("date") ?>

    <?= $form->field($model, 'data_fim')->input("date") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
