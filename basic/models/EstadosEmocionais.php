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
 * @property Usuarios $usuario0
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
            [['tipo_estado_emocional', 'usuario', 'data'], 'required'],
            [['tipo_estado_emocional', 'usuario'], 'integer'],
            [['motivo'], 'string', 'max' => '2000'],
            [['data'], 'date', 'format' => 'yyyy-mm-dd']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_estado_emocional' => 'ID',
            'tipo_estado_emocional' => 'Tipo Estado Emocional',
            'usuario' => 'Usuario',
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
        return $this->hasOne(TiposEstadosEmocionais::className(), ['id_tipo_estado_emocional' => 'tipo_estado_emocional']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioO()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario']);
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
        $usuario = $this->usuarioO;
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
}
