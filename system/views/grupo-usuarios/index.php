<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GrupoUsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grupos de Usuários';

if (Yii::$app->user->identity->isAdmin()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Administrador', 'url' => Url::toRoute(['site/menu-admin'])];
}else if (Yii::$app->user->identity->isColab()){
    $this->params['breadcrumbs'][] = ['label' => 'Menu Colaborador', 'url' => Url::toRoute(['site/menu-colaborador'])];
}
    $this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['mensagens/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    $this->registerJs(
       '$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       $this::POS_READY, "myHideScript"
    );
    ?>
<div class="grupo-usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Grupo de Usuários', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'nome',
            'descricao',
            [
                'label' => 'Membros',
                'format' => 'raw',
                'value' => function ($data) {
                        $usuarios = $data->usuarios;
                        $membros = [];
                        foreach ($usuarios as $usuario) {
                            $membros[] = $usuario->nome_completo; 
                        }
                        return implode(", ", $membros);
                      },
            ],
            [
                'label' => 'Editar Membros',
                'format' => 'raw',
                'value' => function ($data) {
                        return Html::a(" ", ['edit', 'id' => $data->id_grupo_usuarios], [ 'class' => 'glyphicon glyphicon-user']);
                      
                },
            ],
            [
                'header' => 'Editar/Deletar',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
     <?php 
            if (Yii::$app->session->hasFlash("success")) {
                echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            if (Yii::$app->session->hasFlash("error")) {
                echo '<div class="alert alert-error" role="alert">' . Yii::$app->session->getFlash('error') . '</div>';
            }
    ?>
</div>
