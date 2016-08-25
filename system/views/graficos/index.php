<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensagensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gráficos';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
}
    $this->params['breadcrumbs'][] = 'Gráficos';
?>

<?php
    $this->registerJs(
       '$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       $this::POS_READY, "myHideScript"
    );
    ?>
<div class="graficos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><a href="<?= Url::toRoute(["graficos/mes", 'mes' => date('n'), 'ano' => date('Y')])?>" class="btn btn-primary"><span class="glyphicon glyphicon-stats"></span> Gráfico por mês</a></p>
    <p><a href="<?= Url::toRoute(["graficos/mensal", 'ano' => date('Y')])?>" class="btn btn-primary"><span class="glyphicon glyphicon-stats"></span> Gráfico mensais por ano</a></p>
    <p><a href="<?= Url::toRoute(["graficos/ano", 'ano' => date('Y')])?>" class="btn btn-primary"><span class="glyphicon glyphicon-stats"></span> Gráfico anuais</a></p>
    <p><a href="<?= Url::toRoute(["configuracoes/update", 'id' => 1])?>" class="btn btn-primary"><span class="glyphicon glyphicon-stats"></span> Redefinir Meta </a></p>
    <?php
            if (Yii::$app->session->hasFlash("success")) {
                echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if (Yii::$app->session->hasFlash("error")) {
                echo '<div class="alert alert-error" role="alert">' . Yii::$app->session->getFlash('error') . '</div>';
            }
    ?>
</div>
<?php
    $this->registerJs(
       '$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       View::POS_READY, "myHideScript"
    );
    ?>
