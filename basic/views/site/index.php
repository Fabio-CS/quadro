<?php

/* @var $this yii\web\View */
use app\models\Usuarios;
use app\models\Avisos;
use yii\bootstrap\Carousel;

$this->title = 'Quadro Emocional';
?>
<div class="site-index">
    <!--<div class="titulo">
        <h1>Global Eletronics</h1>
        <h3>Slogan aqui!</h3>
    </div>-->
    <div class="body-content">
        <div class="row">
            <div class="col-lg-10">
                <h1>Humores</h1>
                <ul class="humores-mural">
                    <?php   $usuarios = Usuarios::find()->where(['ativo' => 1])->orderBy(['nome_completo' => 'SORT_ASC'])->all();
                            foreach ($usuarios as $key => $usuario) {
                                
                            
                    ?>
                    <li>
                        <div>
                            <img class="foto-perfil" src="<?= $usuario->getImageUrl() ?>" alt="<?= $usuario->nome_completo ?>" title="<?= $usuario->nome_completo ?>">
                            <?php 
                                    if($usuario->isBirthday()){ ?>
                                        <img class="aniversario1" src="images/party1.png">
                                        <img class="aniversario2" src="images/party2.png">
                            <?php   } ?>
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
                    <!--<li>
                        <div>
                            <img class="foto-perfil" src="uploads/LCUQA5NZotJyg-dzdl4zTenYkTiTttid.jpg" alt="Nome da Pessoa" title="Nome da Pessoa">
                            <img class="estado-emocional" src="uploads/vZTrWCRq4yhpk_EMwMM8qZh43SYtR5wL.png">
                        </div>
                        <p>Nome da Pessoa</p>
                    </li>
                    <li>
                        <div>
                            <img class="foto-perfil" src="uploads/LCUQA5NZotJyg-dzdl4zTenYkTiTttid.jpg" alt="Nome da Pessoa" title="Nome da Pessoa">
                            <img class="estado-emocional" src="uploads/yHyp2mB-zRb8U4Bit3L1QnM3KVvv22EL.png">
                            <img class="aniversario1" src="images/party1.png">
                            <img class="aniversario2" src="images/party2.png">
                        </div>
                        <p>Nome da Pessoa</p>
                    </li>
                    <li>
                        <div>
                            <img class="foto-perfil" src="uploads/LCUQA5NZotJyg-dzdl4zTenYkTiTttid.jpg" alt="Nome da Pessoa" title="Nome da Pessoa">
                            <img class="estado-emocional" src="uploads/D66eV1z3iREoWnpUmUKoxm94RALhgHA_.png">
                            <img class="estado-emocional secundario" src="uploads/3eExOW0WOT4_OWXtuAXJ2Xqh3a32_dbu.png">
                        </div>
                        <p>Nome da Pessoa</p>
                    </li>-->
                </ul>
            </div>
            <div class="col-lg-2">
                <h1>Avisos</h1>
                <?php
                        $avisos = Avisos::getActiveAvisos();

                        $carouselData =[];
                        foreach ($avisos as $key => $aviso) {
                            $item = [];
                            if($aviso->hasImage()){
                                $item['content'] = "<div class='aviso_image'><h2 class='titulo_carousel'>$aviso->titulo</h2><img src='".$aviso->getImageUrl()."' class='image_aviso'><p class='caption_carousel'>$aviso->descricao</p></div>";
                                
                            }else{
                                $item['content'] = "<div class='aviso_texto'><h2 class='titulo_aviso'>$aviso->titulo</h2><p class='descricao_aviso'>$aviso->descricao</p></div>";
                            }
                            
                            $item['options'] = [
                                'interval' => ($aviso->tempo_exibicao * 1000),
                                'controls' => false
                            ];
                            $carouselData[] = $item;
                        }
                        
                        echo Carousel::widget([
                                            'items' => $carouselData
                                        ]);
                ?>
            </div>
        </div>

    </div>
</div>
