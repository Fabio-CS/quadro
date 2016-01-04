<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

?>
<p>Por favor, preencha as informações abaixo para realizar o login: </p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'matricula', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'value' => '']]) ?>

        <?php  if($model->scenario == 'web') {
            echo $form->field($model, 'password')->passwordInput();
        } ?>


        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
<?php
            if (Yii::$app->session->hasFlash("success")) {
                echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if (Yii::$app->session->hasFlash("error")) {
                echo '<div class="alert alert-error" role="alert">' . Yii::$app->session->getFlash('error') . '</div>';
            }
            if (!empty(Yii::$app->request->get("msg"))) {
                echo '<div class="alert alert-success" role="alert"> Check-in realizado com sucesso! </div>';
            }
            ?>
    <?php ActiveForm::end(); ?>
