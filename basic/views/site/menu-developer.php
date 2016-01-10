<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    
    $this->title = 'Menu Developer';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-menu-developer">
    <h1><?= Html::encode($this->title) ?></h1>
    <ul>
        <li>
            <a href="<?= Url::toRoute(["tipos-usuario/index"]) ?>">
            Tipos de Usuários
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(["tipos-estados-emocionais/index"]) ?>">
            Tipos de Estados Emocionais
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(["tipos-afastamento/index"]) ?>">
            Tipos de afastamento
            </a>
        </li>
        <li>
            <a href="<?= Url::toRoute(["usuarios/index"]) ?>">
            Usuários
            </a>
        </li>
    </ul>
        <?php
        
    ?>
</div>