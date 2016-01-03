<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */

$this->title = 'Check-in de Estado Emocional';
$this->params['breadcrumbs'][] = ['label' => 'Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-emocionais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>