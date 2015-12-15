<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo_usuarios_has_usuarios".
 *
 * @property integer $id_grupo_usuarios
 * @property integer $id_usuario
 *
 * @property GrupoUsuarios $idGrupoUsuarios
 * @property Usuarios $idUsuario
 */
class GrupoHasUsuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_usuarios_has_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_grupo_usuarios', 'id_usuario'], 'required'],
            [['id_grupo_usuarios', 'id_usuario'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_grupo_usuarios' => 'Id Grupo Usuarios',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupoUsuarios()
    {
        return $this->hasOne(GrupoUsuarios::className(), ['id_grupo_usuarios' => 'id_grupo_usuarios']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
