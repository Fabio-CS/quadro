<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoHasUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grupo-has-usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_grupo_usuarios')->textInput() ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
