<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curtidas".
 *
 * @property integer $id_curtida
 * @property integer $usuario
 * @property string $motivo
 * @property integer $ativo
 *
 * @property Usuarios $usuario
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
            [['usuario', 'motivo'], 'required'],
            [['usuario'], 'integer'],
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
            'criado_em' => 'Enviada em'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioO()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario']);
    }
}
