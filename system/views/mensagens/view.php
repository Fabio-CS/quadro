<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mensagens */

$this->title = $model->assunto;
$this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    $this->registerJs(
       '$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       $this::POS_READY, "myHideScript"
    );
    ?>
<div class="mensagens-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'assunto',
            'texto',
            [
                'label' => 'Destinatário',
                'attribute' => 'destinatario.nome_completo'
            ],
            [
                'label' => 'Lida',
                'format' => 'raw',
                'value' => $model->getDisplayLida()
            ],
            [
                'label' => 'Resposta de',
                'format' => 'raw',
                'value' => $model->getOriginalLink()
	    ],
            [
                'label' => 'Remetente',
                'attribute' => 'remetente.nome_completo'
	    ],
            [
                'label' => 'Enviada em',
                'format' => 'raw',
                'value' => $model->getDisplayEnviada()
	    ],
            [
                'label' => 'Responder',
                'format' => 'raw',
                'value' => $model->getResponderLink()
            ]
        ],
    ]) ?>
    <p>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php 
            if (Yii::$app->session->hasFlash("success")) {
                echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if (Yii::$app->session->hasFlash("error")) {
                echo '<div class="alert alert-error" role="alert">' . Yii::$app->session->getFlash('error') . '</div>';
            }
    ?>

</div>
