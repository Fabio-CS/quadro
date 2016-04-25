<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use app\models\GrupoUsuarios;
use yii\helpers\ArrayHelper;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-usuarios-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_grupo_usuarios')->dropdownList(
            ArrayHelper::map(GrupoUsuarios::find()->where(['ativo' => 1])->orderBy('nome')->all(), 'id_grupo_usuarios', 'nome'), ['prompt'=>'Selecione o grupo', 'disabled' => 'disabled']); ?>
    <?= $form->field($model, 'usuarios')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Usuarios::find()->where(['ativo' => 1])->orderBy('nome_completo')->all(), 'id_usuario', 'nome_completo'),
        'value' => ArrayHelper::map($model->usuarios, 'id_usuario', 'nome_completo'),
        'options' => ['placeholder' => 'Selecione os usuários...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true
        ],
    ]); ?>
    <?= $form->field($model, 'id_grupo_usuarios')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Incluir' : 'Salvar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
