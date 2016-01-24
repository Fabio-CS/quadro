<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Avisos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'tempo_exibicao')->textInput() ?>

    <?= $form->field($model, 'data_inicio')->input("date") ?>

    <?= $form->field($model, 'data_fim')->input("date") ?>

    <?= $form->field($model, 'imagem')->widget(FileInput::classname(),
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
                                 Html::img($model->getImageUrl(), ['class'=>'file-preview-image', 'alt'=>'Imagem atual', 'title'=>'Imagem Atual']),
                ]
            ]
            ]
    ); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
