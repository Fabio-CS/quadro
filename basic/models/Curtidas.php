<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curtidas".
 *
 * @property integer $id_curtida
 * @property integer $usuario
 * @property string $motivo
 * @property integer $criado_por
 * @property string $criado_em
 * @property integer $modificado_por
 * @property string $modificado_em
 * @property integer $ativo
 *
 * @property Usuarios $criadoPor
 * @property Usuarios $modificadoPor
 * @property Usuarios $usuario0
 */
class Curtidas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curtidas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'motivo', 'criado_por'], 'required'],
            [['usuario', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['criado_em', 'modificado_em'], 'safe'],
            [['motivo'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_curtida' => 'ID',
            'usuario' => 'Usuário',
            'motivo' => 'Motivo',
            'criado_por' => 'Criado por',
            'criado_em' => 'Criado em',
            'modificado_por' => 'Modificado por',
            'modificado_em' => 'Modificado em',
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
    public function getUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario']);
    }
}
