<?php

namespace app\models;
use app\models\Usuarios;
use Yii;

/**
 * This is the model class for table "estados_emocionais".
 *
 * @property integer $id_estado_emocional
 * @property integer $tipo_estado_emocional
 * @property integer $usuario
 * @property string $data
 * @property integer $criado_por
 * @property string $criado_em
 * @property integer $modificado_por
 * @property string $modificado_em
 * @property integer $ativo
 *
 * @property Usuarios $criadoPor
 * @property Usuarios $modificadoPor
 * @property TiposEstadosEmocionais $tipoEstadoEmocional
 * @property Usuarios $usuario returna o usuário do estado emocional
 */
class EstadosEmocionais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estados_emocionais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_estado_emocional', 'id_usuario', 'data'], 'required', 'on' => 'create'],
            [['id_tipo_estado_emocional', 'id_usuario'], 'integer'],
            [['motivo'], 'string', 'max' => '2000'],
            [['data'], 'date', 'format' => 'yyyy-mm-dd'],
            [['id_tipo_estado_emocional', 'id_usuario', 'data'], 'required', 'on' => 'update']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_estado_emocional' => 'ID',
            'id_tipo_estado_emocional' => 'Humor',
            'id_usuario' => 'Usuário',
            'data' => 'Data',
            'motivo' => 'Motivo',
            'criado_por' => 'Criado Por',
            'criado_em' => 'Criado Em',
            'modificado_por' => 'Modificado Por',
            'modificado_em' => 'Modificado Em',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriadoPor()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'criado_por']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModificadoPor()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'modificado_por']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoEstadoEmocional()
    {
        return $this->hasOne(TiposEstadosEmocionais::className(), ['id_tipo_estado_emocional' => 'id_tipo_estado_emocional']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'id_usuario']);
    }
    
    public function getIconeUrl(){
        $tipoEstadoEmocional = $this->getTipoEstadoEmocional()->one();
        return $tipoEstadoEmocional->getImageUrl();
    }
    
    public function isBadState(){
        if (in_array($this->tipoEstadoEmocional->nome, Yii::$app->params["estadosRuins"])){
            return true;
        }else{
            return false;
        }
    }
    
    public function sendEmail(){
        if($this->isBadState()){
        $usuario = $this->usuario;
        $body = "<h1>Colaborador com estado emocional ruim</h1>".
                "<p>O colaborador " . "<b>" . $usuario->nome_completo . "</b> do setor <b>". $usuario->setor ."</b> " .
                "apresentou um estado emocional ruim <i>(". $this->tipoEstadoEmocional->nome .")</i> durante o check-in de hoje! </p>".
                "<p> Por favor, tome as medidas necessárias e acesse o sistema para registrar a solução apresentada. </p>".
                "<p></p>".
                "Atenciosamente,<br>".Yii::$app->params["systemName"];
        $subject = "Alerta do Sistema ". Yii::$app->params["systemName"] ." - colaborador com estado emocional ruim";
        $emails = Usuarios::getAdminsEmails();
        Yii::$app->mailer->compose()
                ->setTo($emails)
                ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["systemName"]])
                ->setSubject($subject)
                ->setHtmlBody($body)
                ->send();
        }
    
    }
    
    public static function getGraficoData($ano){
       $consulta = "SELECT tipos_estados_emocionais.nome, count(estados_emocionais.id_tipo_estado_emocional) as total, extract(MONTH from estados_emocionais.data) as mes FROM estados_emocionais left outer join tipos_estados_emocionais on estados_emocionais.id_tipo_estado_emocional = tipos_estados_emocionais.id_tipo_estado_emocional WHERE estados_emocionais.ativo = 1 and tipos_estados_emocionais.privado = 0 and YEAR(estados_emocionais.data) = $ano GROUP BY tipos_estados_emocionais.nome, mes ORDER by mes";
       $arrayGrafico = Yii::$app->db->createCommand($consulta)->queryAll();
       $estadosNull = [
           'Bom' => 0,
           'Regular' => 0,
           'Ruim' => 0
       ];
       $meses = [
               1 => $estadosNull,
               2 => $estadosNull,
               3 => $estadosNull,
               4 => $estadosNull,
               5 => $estadosNull,
               6 => $estadosNull,
               7 => $estadosNull,
               8 => $estadosNull,
               9 => $estadosNull,
               10 => $estadosNull,
               11 => $estadosNull,
               12 => $estadosNull
           ];
        $mesesNomes = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];

       foreach ($arrayGrafico as $key => $value) {
           $mes   = $value['mes'];
           $nome  = $value['nome'];
           $total = $value['total'];
           $meses[$mes][$nome] = $total;
       };
       
       $arrayCategorias = EstadosEmocionais::clearGraficoArray($meses, $mesesNomes);
       
       $arrayData = EstadosEmocionais::arrayByEstado($meses);
       
       $grafico = [
           'categorias' => $arrayCategorias,
           'data' => $arrayData
       ];
           return $grafico;
    }
    
    protected static function clearGraficoArray($arrayData, $arrayMeses){
        foreach ($arrayData as $key => $value) {
            if($value['Bom'] == 0 && $value['Regular'] == 0 && $value['Ruim'] == 0){
                unset($arrayMeses[$key]);
            }
        }
        
        $mesesFinal = [];
        
        foreach ($arrayMeses as $key => $value) {
            $mesesFinal[] = $value;
        }
        
        return $mesesFinal;
    }
    
    protected static function arrayByEstado($array){
        $bom = [];
        $regular = [];
        $ruim = [];
        
        foreach ($array as $key => $value) {
            if($value['Bom'] == 0 && $value['Regular'] == 0 && $value['Ruim'] == 0){
                unset($array[$key]);
            }
        }
        
        foreach ($array as $key => $value) {
            $bom[]      = (int)$value['Bom'];
            $regular[]  = (int)$value['Regular'];
            $ruim[]     = (int)$value['Ruim'];
        }
        
        return [
            'Bom' => $bom,
            'Regular' => $regular,
            'Ruim' => $ruim
        ];
    }
    
}

