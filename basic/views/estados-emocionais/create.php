<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosEmocionais */

$this->title = 'Criar Estado Emocional';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
$this->params['breadcrumbs'][] = ['label' => 'Estados Emocionais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-emocionais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
