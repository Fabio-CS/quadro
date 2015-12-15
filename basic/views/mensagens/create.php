<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mensagens */

$this->title = 'Create Mensagens';
$this->params['breadcrumbs'][] = ['label' => 'Mensagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensagens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
