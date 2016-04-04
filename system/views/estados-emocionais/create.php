<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */

$this->title = 'Sugerir Estado Emocional';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
    $this->params['breadcrumbs'][] = ['label' => 'Humor', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->id_estado_emocional, 'url' => ['view', 'id' => $model->id_estado_emocional]];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
    $this->params['breadcrumbs'][] = 'Sugerir';
}
?>
<div class="estados-emocionais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
