<?php

namespace app\models;

use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "mensagens".
 *
 * @property integer $id_mensagem
 * @property string $texto
 * @property integer $id_destinatario
 * @property string $lida
 * @property integer $resposta_de
 * @property integer $criado_por
 * @property string $criado_em
 * @property integer $ativo
 *
 * @property Usuarios $criadoPor
 * @property Usuarios $destinatario
 * @property Mensagens $respostaDe
 * @property Mensagens[] $mensagens
 */
class Mensagens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensagens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assunto', 'texto', 'id_destinatario'], 'required', 'on' => 'enviar'],
            [['assunto', 'texto', 'id_destinatario'], 'required', 'on' => 'group'],
            [['assunto', 'texto', 'id_destinatario'], 'required', 'on' => 'resposta'],
            [['id_destinatario', 'resposta_de', 'ativo'], 'integer'],
            [['resposta_de'], 'required', 'on' => 'resposta'],
            [['texto'], 'string', 'max' => 5000],
            [['assunto'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mensagem' => 'ID Mensagem',
            'assunto' => 'Assunto',
            'texto' => 'Texto',
            'id_destinatario' => 'Destinatário',
            'lida' => 'Lida',
            'resposta_de' => 'Resposta De',
            'criado_por' => 'Remetente',
            'criado_em' => 'Criado Em',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemetente()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'criado_por']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestinatario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'id_destinatario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespostaDe()
    {
        return $this->hasOne(Mensagens::className(), ['id_mensagem' => 'resposta_de']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensagens()
    {
        return $this->hasMany(Mensagens::className(), ['resposta_de' => 'id_mensagem']);
    }
    
    public function GetTruncatedMensagemText()
    {
        if (strlen($this->texto) <= 100) {
            return $this->texto;
        } else {
            return substr($this->texto, 0, 100) . '...';
        }
    }
    
    public function getDisplayLida()
    {
        if($this->lida){
            $oDate = new \DateTime($this->lida);
            $value = $oDate->format('d/m/Y - H:m:s');
        }else{
            $value = 'Não';
        }
        return $value;
    }
    
    public function getDisplayEnviada()
    {
        $oDate = new \DateTime($this->criado_em);
        $value = $oDate->format('d/m/Y - H:m:s');
        return $value;
    }
    
    public function getOriginalLink()
    {
        return Html::a($this->respostaDe->assunto, ['view', 'id' => $this->respostaDe->id_mensagem]);
    }
    
    public function getResponderLink()
    {
        return Html::a('Responder', ['reply', 'id' => $this->id_mensagem]);
    }
    
    public function isLida(){
        return $this->lida ? true : false;
    }
}
