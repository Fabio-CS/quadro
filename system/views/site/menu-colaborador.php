<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use app\models\TiposEstadosEmocionais;
    use app\models\EstadosEmocionais;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Url;
    
    $this->title = 'Menu Colaborador';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-menu-colaborador">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="menu-colaborador">
    <ul>
        <li>
            <?php
            $humor = Yii::$app->user->getIdentity()->getEstadoEmocionalPrincipal();
            ?>
            <a href="<?= Url::toRoute(["estados-emocionais/update", 'id' => $humor->id_estado_emocional])?>">
            <img src="images/humores.png">
            <p>Editar Humor</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(["estados-emocionais/create"])?>">
            <img src="images/sugestao.png">
            <p>Sugerir Humor</p>
            </a>
        </li>
 <!--       <li>
            <a href="<?= Url::toRoute(["mensagens/index"])?>">
            <img src="images/mensagens.png">
            <p>Mensagens</p>
            </a>
        </li> --> 
    </ul>
</div>