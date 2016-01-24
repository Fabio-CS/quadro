<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposEstadosEmocionais */

$this->title = 'Criar Tipo de Estado Emocional';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-estados-emocionais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
