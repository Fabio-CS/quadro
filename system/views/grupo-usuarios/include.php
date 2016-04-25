<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\GrupoUsuarios */

$this->title = 'Incluir usuários em grupo:' ;
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
}
    $this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['mensagens/index']];
$this->params['breadcrumbs'][] = ['label' => 'Grupos de Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Incluir usuários';

?>
<div class="grupo-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_include', [
        'model' => $model,
    ]) ?>

</div>
