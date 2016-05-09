<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;

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
    <h2>Ano de <?= $ano ?></h2>
    
    <?=  Highcharts::widget([
        'scripts' => ['modules/exporting'],
        'options' => [
            'chart' => [
                'type' => 'column'
            ],
            'title' => ['text' => 'Satisfação colaboradores'],
            'credits' => false,
            'colors' => [ '#2ecc71', '#f1c40f', '#e74c3c'],
            'xAxis' => [
                'categories' => $grafico['categorias']
                ],
            'yAxis' => [
                'title' => ['text' => 'Percentual de funcionários'],
                'min' => 85,
                'reversed' => false,
                'reversedStacks' => false,
                'plotLines' => [[
                        'value' => 94,
                        'color' => '#000',
                        'width' => 2,
                        'zIndex' => 4,
                        'label' => [ 'text' => 'meta' ]
                ]]
            ],
            'tooltip' => [
                'enabled' => true,
                'pointFormat' => '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                'shared' => true
            ],
            'plotOptions' => [
                'column' => [
                    'stacking' => 'percent'
                ]
            ],
           'series' => [
                ['name' => '% Bom', 'data' => $grafico['data']['Bom']],
                ['name' => '% Regular', 'data' => $grafico['data']['Regular']],
                ['name' => '% Ruim', 'data' => $grafico['data']['Ruim']]
           ]
        ]
    ]);
    ?>
    <?php foreach ($grafico['categorias'] as $key => $value) { ?>
    <div class="total-meses">
        <h3><?= $value ?></h3>
        <p>Bom:     <?= $grafico['data']['Bom'][$key] ?> </p>
        <p>Regular: <?= $grafico['data']['Regular'][$key] ?></p>
        <p>Ruim:    <?= $grafico['data']['Ruim'][$key] ?> </p>
    </div>
    <?php } ?>
    <br class="clear">
    <p><a href="<?= Url::toRoute(["graficos/index", 'ano' => $ano-1])?>" class="btn btn-primary"><span class="glyphicon glyphicon-backward"></span> Ano anterior <?= $ano-1 ?></a> <a href="<?= Url::toRoute(["graficos/index", 'ano' => date('Y')])?>" class="btn btn-primary"><span class="glyphicon glyphicon-stats"></span> Ano Atual <?= date('Y') ?></a></p>

    <?php 
            if (Yii::$app->session->hasFlash("success")) {
                echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if (Yii::$app->session->hasFlash("error")) {
                echo '<div class="alert alert-error" role="alert">' . Yii::$app->session->getFlash('error') . '</div>';
            }
    ?>
</div>
