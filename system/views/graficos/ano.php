<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MensagensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gráficos';
if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
}
    $this->params['breadcrumbs'][] = ['label' => 'Gráficos', 'url' => Url::toRoute(['graficos/index'])];
    
    $this->params['breadcrumbs'][] = 'Gráfico anual';
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
                'categories' => [$ano]
                ],
            'yAxis' => [
                'title' => ['text' => 'Percentual de funcionários'],
                'min' => 85,
                'reversed' => false,
                'reversedStacks' => false,
                'plotLines' => [[
                        'value' => $meta,
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
                ['name' => '% Bom', 'data' => [$grafico['data']['Bom']]],
                ['name' => '% Regular', 'data' => [$grafico['data']['Regular']]],
                ['name' => '% Ruim', 'data' => [$grafico['data']['Ruim']]]
           ]
        ]
    ]);
    ?>
    <div class="total-meses">
        <h3><?= $ano ?></h3>
        <p>Bom:     <?= $grafico['data']['Bom'] ?> </p>
        <p>Regular: <?= $grafico['data']['Regular'] ?></p>
        <p>Ruim:    <?= $grafico['data']['Ruim'] ?> </p>
    </div>
    <br class="clear">
    <h3>Pesquisar por Ano:</h3>
    <?php $form = ActiveForm::begin(["action" => ["graficos/ano"], 'method'=>'get']); ?>
        <label for="ano" class="control-label">Ano:</label>
        <select name="ano" id="ano" class="form-control" required="true">
            <option value="">Selecione o ano</option>
            <?php for ($year = 2016; $year <= date('Y'); $year++) { ?> 
            <option value="<?=$year?>"><?=$year?></option>
            <?php } ?>
        </select>
        <br>
        <button type="submit" class="btn btn-success"> Pesquisar </button>
    <?php ActiveForm::end(); ?>
    <br>
    <p><a href="<?= Url::toRoute(["graficos/index"])?>" class="btn btn-primary"><span class="glyphicon glyphicon-backward"></span> Voltar </a></p>

    <?php 
            if (Yii::$app->session->hasFlash("success")) {
                echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if (Yii::$app->session->hasFlash("error")) {
                echo '<div class="alert alert-error" role="alert">' . Yii::$app->session->getFlash('error') . '</div>';
            }
    ?>
</div>
