<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'num_matricula') ?>

    <?= $form->field($model, 'nome_completo') ?>

    <?php //echo $form->field($model, 'data_nasc') ?>

    <?= $form->field($model, 'funcao') ?>

    <?php echo $form->field($model, 'setor') ?>

    <?php //echo $form->field($model, 'foto') ?>

    <?php //echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'senha') ?>

    <?php echo $form->field($model, 'tipo_usuario') ?>

    <?php // echo $form->field($model, 'ativo') ?>

    <?php // echo $form->field($model, 'criado_por') ?>

    <?php // echo $form->field($model, 'criado_em') ?>

    <?php // echo $form->field($model, 'modificado_por') ?>

    <?php // echo $form->field($model, 'modificado_em') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
