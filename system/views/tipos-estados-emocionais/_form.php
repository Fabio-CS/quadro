<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\TiposEstadosEmocionais */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipos-estados-emocionais-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'privado')->radioList(['1'=>'Privado', '0'=>'Público']); ?>
    <?= $form->field($model, 'icone')->widget(FileInput::classname(),
        ($model->scenario == "create") ?
        [ 
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'allowedFileExtensions' => ['jpg','jpeg','png','tif','tiff'],
                'showUpload' => false
            ]
        ] : [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
            'allowedFileExtensions' => ['jpg','jpeg','png','tif','tiff'],
            'showUpload' => false,
            'showRemove' => false,
            'initialPreview' => [
                                 Html::img($model->getImageUrl(), ['class'=>'file-preview-image', 'alt'=>'Ícone atual', 'title'=>'Ícone Atual']),
                ]
            ]
            ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
