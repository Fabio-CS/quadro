<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensagensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mensagens';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
}
    $this->params['breadcrumbs'][] = 'Mensagens';
?>

<?php
    $this->registerJs(
       '$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       $this::POS_READY, "myHideScript"
    );
    ?>
<div class="mensagens-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
      
    ?>
    <p>
        <?= Html::a(Html::tag('span', ' ', ['class' => 'glyphicon glyphicon-envelope']).'  &nbsp;Enviar Mensagens', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Html::tag('span', ' ', ['class' => 'glyphicon glyphicon-send']).' &nbsp;Mensagens Enviadas', ['sent'], ['class' => 'btn btn-primary']) ?>
        <?php if(Yii::$app->user->identity->isAdmin()) { ?>
            <?= Html::a(Html::tag('span', ' ', ['class' => 'glyphicon glyphicon-tags']).' &nbsp;Grupo de Mensagens', ['/grupo-usuarios/index'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Html::tag('span', ' ', ['class' => 'glyphicon glyphicon-list-alt']).' &nbsp;Enviar Mensagens para Grupos', ['group'], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
    </p>
    <h2>Mensagens Recebidas</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Enviada em',
                'format' => 'raw',
                'value' => function ($data) {
                        return $data->getDisplayEnviada();
                      },
	    ],
            [
                'label' => 'Assunto',
                'format' => 'raw',
                'value' => function ($data) {
                        return Html::a($data->assunto, ['view', 'id' => $data->id_mensagem], [ 'class' => $data->isLida() ? '' : 'bold']);
                      },
            ],
            [
                'label' => 'Mensagem',
                'format' => 'raw',
                'value' => function ($data) {
                        return $data->GetTruncatedMensagemText();
                      },
            ],
            [
                'label' => 'Remetente',
                'attribute' => 'remetente.nome_completo'
	    ],
            [
                'label' => 'Resposta de',
                'format' => 'raw',
                'value' => function ($data) {
                        return Html::a($data->respostaDe->assunto, ['view', 'id' => $data->respostaDe->id_mensagem]);
                      },
	    ],
            [
                'label' => 'Responder',
                'format' => 'raw',
                'value' => function ($data) {
                        return Html::a('Responder', ['reply', 'id' => $data->id_mensagem]);
                      },
            ],
            [
                'label' => 'Mensagem Lida',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->getDisplayLida();
                }
            ],
            [
                'label' => 'Marcar como lida',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'value' => function($data) {
                        if(!$data->isLida()){
                            return Html::a('', ['read', 'id' => $data->id_mensagem], [
                                    'class' => 'glyphicon glyphicon-eye-open',
                                    'data' => [
                                        'confirm' => 'Tem certeza que você quer marcar essa mensagem como lida?',
                                        'method' => 'post',
                                    ],
                                ]);
                            }
                            return '';
                        }
            ],
        ],
    ]); ?>
    <?php 
            if (Yii::$app->session->hasFlash("success")) {
                echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if (Yii::$app->session->hasFlash("error")) {
                echo '<div class="alert alert-error" role="alert">' . Yii::$app->session->getFlash('error') . '</div>';
            }
    ?>
</div>
