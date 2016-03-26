<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PeriodosAfastamento */

$this->title = 'Inserir Períodos Afastamento';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}
$this->params['breadcrumbs'][] = ['label' => 'Períodos de Afastamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-afastamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
