<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php 
    $useragent = Yii::$app->request->userAgent;
    if (in_array("(iPad;", explode(" ", $useragent))){
        $mobile = true;
    }else{
        $mobile = false;
    }
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logo_global_simples.png', ['alt'=>'Global Eletronics', 'class' => 'logo_navbar'])." Global Eletronics",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ?
                [ 'label' => '' ] : [
                    'label' => 'Menu Principal',
                    'url' => Yii::$app->user->identity->getMenu()
                ],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/usuarios/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->nome_completo . ')',
                    'url' => ['/usuarios/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
            [
                'label' => 'Login Local',
                'url' => ["/usuarios/local"],
                'visible' => $mobile
            ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Global Electronics <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
