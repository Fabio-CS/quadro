<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Carousel;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = Yii::$app->params["systemName"];
?>
<div class="site-index">
    <!--<div class="titulo">
        <h1>Global Eletronics</h1>
        <h3>Slogan aqui!</h3>
    </div>-->
    <div class="body-content">
        <div class="row">
            <div class="col-lg-10">
                <h1>Smileboard</h1>
                    <?php Pjax::begin(); ?>
                    <ul class="humores-mural">
                    <?= Html::a("", ['site/index'], ['style' => 'display:none', 'id' => 'refreshHumores']);?>
                    <?php   
                            foreach ($usuarios as $key => $usuario) {        
                    ?>
                    <li>
                        <div>
                            <img class="foto-perfil" src="<?= $usuario->getImageUrl() ?>" alt="<?= $usuario->nome_completo ?>" title="<?= $usuario->nome_completo ?>">
                            <?php 
                                    $estadoEmocionalPrincipal = $usuario->getEstadoEmocionalPrincipal();
                                    if(!empty($estadoEmocionalPrincipal)) { ?>
                                        <img class="estado-emocional" src="<?= $estadoEmocionalPrincipal->getIconeUrl() ?>">
                            <?php   } ?>
                            <?php 
                                $estadoEmocionalSecundario = $usuario->getEstadoEmocionalSecundario();
                                if(!empty($estadoEmocionalSecundario)) { ?>
                                       <img class="estado-emocional secundario" src="<?= $estadoEmocionalSecundario->getIconeUrl() ?>">
                          <?php } ?>
                        </div>
                        <p><?= $usuario->getDisplayName() ?></p>
                    </li>
                    <?php } ?>
                    <?php Pjax::end(); ?>
               </ul>
            </div>
            <div class="col-lg-2 avisos">
                <h1>Avisos</h1>
                <?= Html::a("", ['site/index'], ['style' => 'display:none', 'id' => 'refreshAvisos']);?>
                <?php
                        $carouselData =[];
                        $sumInterval = 0;
                        
                        foreach ($usuarios as $key => $usuario) {
                            if($usuario->isBirthday()){
                                $item = [];
                                $sumInterval = $sumInterval + 10;
                                $item['content'] = "<div class='aviso_image'><h2 class='titulo_carousel'>Aniversariante</h2><div class='aniversariante'><img src='".$usuario->getImageUrl()."' class='image_aviso'><img class='aniversario1' src='images/party1.png'><img class='aniversario2' src='images/party2.png'><img class='aniversario3' src='images/balloon.png'></div><p class='caption_carousel'> <b> ".$usuario->getDisplayName()."</b> <br>".Yii::$app->params['msgAniversario']."</p></div>";
                                $item['options'] = [
                                'data-interval' => (10 * 1000),
                                'controls' => false
                            ];
                                $carouselData[] = $item;
                            }
                        }
                        
                        foreach ($avisos as $key => $aviso) {
                            $item = [];
                            $sumInterval = $sumInterval + $aviso->tempo_exibicao;
                            if($aviso->hasImage()){
                                $item['content'] = "<div class='aviso_image'><h2 class='titulo_carousel'>$aviso->titulo</h2><img src='".$aviso->getImageUrl()."' class='image_aviso'><p class='caption_carousel'>$aviso->descricao</p></div>";
                                
                            }else{
                                $item['content'] = "<div class='aviso_texto'><h2 class='titulo_aviso'>$aviso->titulo</h2><p class='descricao_aviso'>$aviso->descricao</p></div>";
                            }
                            
                            $item['options'] = [
                                'data-interval' => ($aviso->tempo_exibicao * 1000),
                                'controls' => false
                            ];
                            $carouselData[] = $item;
                        }
                        
                        echo Carousel::widget([
                                            'id' => 'myCarousel',
                                            'items' => $carouselData,
                                            'options' => [ 'class' => 'slide'],
                                            'clientOptions' => [
                                                'interval' => false
                                                ]
                                        ]);
                ?>
            </div>
        </div>

    </div>
</div>

<?php
if (($sumInterval * 1000) < 30000){
    $avisosRefresh = 60000;
}else{
    $avisosRefresh = $sumInterval * 1000 * 2;
}
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshHumores").click(); }, 10000);
    setInterval(function(){ location.reload(); }, $avisosRefresh);
});
JS;
$this->registerJs($script);
$js = <<< JS
$(document).ready(function() {
    var t;
    var start = $('#myCarousel').find('div.carousel-inner').find('div.item.active').attr('data-interval');
    t = setTimeout(function (){ $('#myCarousel').carousel('next'); }, start);
    $('#myCarousel').on('slid.bs.carousel', function () {   
        clearTimeout(t);  
        var duration = $('#myCarousel').find('div.carousel-inner').find('div.item.active').attr('data-interval');
        t = setTimeout(function(){ $('#myCarousel').carousel('next');}, duration);
    });
});
JS;
$this->registerJs($js);
?>

