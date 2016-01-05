<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\TiposEstadosEmocionais;


/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */

$this->title = 'Check-in de Estado Emocional';
$this->params['breadcrumbs'][] = ['label' => 'Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-emocionais-checkin">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2>Olá <?= Html::encode(Yii::$app->user->identity->nome_completo) ?>!</h2>
    <h3>Selecione abaixo seu estado emocional de hoje:</h3>
    <ul>
    <?php
    $estadosEmocionais = TiposEstadosEmocionais::find()->where(['privado' => 0, 'ativo' => 1])->all();
    foreach ($estadosEmocionais as $estadoEmocional) {
    ?>
        <li> <?= Html::a(
                    Html::img($estadoEmocional->getImageUrl(),['width'=>'200', 'height' => '200']),
                    Url::toRoute(['estados-emocionais/checkin', 'tipo_estado_emocional' => $estadoEmocional->id_tipo_estado_emocional]),
                   ['class' => 'btn',
                    'data' => [
                        'confirm' => 'Você está certo que quer selecionar '.$estadoEmocional->nome,
                        'method' => 'post',
                        ]
                   ]
                ); ?> <br> <?= $estadoEmocional->nome ?></li>
    <?php } ?>
    </ul>
</div>