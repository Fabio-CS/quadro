<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TiposUsuario */

$this->title = 'Criar Tipo de Usuário';
if (Yii::$app->user->identity->isDev()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Desenvolvedor', 'url' => Url::toRoute(['site/menu-developer'])];
}
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Usuários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
