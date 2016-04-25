<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo_usuarios".
 *
 * @property integer $id_grupo_usuarios
 * @property string $nome
 * @property string $descricao
 * @property integer $criado_por
 * @property string $criado_em
 * @property integer $modificado_por
 * @property string $modificado_em
 * @property integer $ativo
 *
 * @property Usuarios $criadoPor
 * @property Usuarios $modificadoPor
 * @property Usuarios[] $usuarios
 */
class GrupoUsuarios extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            \cornernote\linkall\LinkAllBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'criado_por'], 'required', 'on' => 'create'],
            [['nome', 'criado_por'], 'required', 'on' => 'update'],
            [['criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['criado_em', 'modificado_em'], 'safe'],
            [['nome'], 'string', 'max' => 50],
            [['descricao'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_grupo_usuarios' => 'Grupo',
            'nome' => 'Nome',
            'descricao' => 'Descrição',
            'criado_por' => 'Criado Por',
            'criado_em' => 'Criado Em',
            'modificado_por' => 'Modificado Por',
            'modificado_em' => 'Modificado Em',
            'ativo' => 'Ativo',
            'usuarios' => 'Usuários'
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
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id_usuario' => 'id_usuario'])->viaTable('grupo_usuarios_has_usuarios', ['id_grupo_usuarios' => 'id_grupo_usuarios']);
    }
}
