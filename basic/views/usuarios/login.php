<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="javascript">
    $("form input:text, form textarea").first().focus();
</script>
<div class="usuario-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_login', [
        'model' => $model,
    ]) ?>
</div>
