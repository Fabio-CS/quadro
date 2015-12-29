<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estados-emocionais-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_estado_emocional')->textInput() ?>

    <?= $form->field($model, 'usuario')->dropdownList(
            Usuarios::find()->select(['nome_completo', 'id'])->indexBy('nome_completo')->column(), ['prompt'=>'Selecione o Usuário']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Inserir' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
