<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensagens".
 *
 * @property integer $id_mensagem
 * @property string $texto
 * @property integer $destinatario
 * @property string $lida
 * @property integer $resposta_de
 * @property integer $criado_por
 * @property string $criado_em
 * @property integer $ativo
 *
 * @property Usuarios $criadoPor
 * @property Usuarios $destinatario0
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
            [['texto', 'destinatario', 'criado_por'], 'required'],
            [['destinatario', 'resposta_de', 'criado_por', 'ativo'], 'integer'],
            [['lida', 'criado_em'], 'safe'],
            [['texto'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mensagem' => 'Id Mensagem',
            'texto' => 'Texto',
            'destinatario' => 'Destinatario',
            'lida' => 'Lida',
            'resposta_de' => 'Resposta De',
            'criado_por' => 'Criado Por',
            'criado_em' => 'Criado Em',
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
    public function getDestinatario0()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'destinatario']);
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
}
