<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_usuario".
 *
 * @property integer $id_tipo_usuario
 * @property string $nome
 * @property string $descricao
 * @property integer $ativo
 *
 * @property Usuarios[] $usuarios
 */
class TiposUsuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['ativo'], 'integer'],
            [['nome', 'descricao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_usuario' => 'Id Tipo Usuario',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['tipo_usuario' => 'id_tipo_usuario']);
    }
}
