<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id_usuario
 * @property string $num_matricula
 * @property string $nome_completo
 * @property string $data_nasc
 * @property string $funcao
 * @property string $setor
 * @property string $foto
 * @property string $email
 * @property string $senha
 * @property integer $tipo_usuario
 * @property integer $ativo
 * @property integer $criado_por
 * @property string $criado_em
 * @property integer $modificado_por
 * @property string $modificado_em
 *
 * @property Avisos[] $avisos
 * @property Avisos[] $avisos0
 * @property Curtidas[] $curtidas
 * @property Curtidas[] $curtidas0
 * @property Curtidas[] $curtidas1
 * @property EstadosEmocionais[] $estadosEmocionais
 * @property EstadosEmocionais[] $estadosEmocionais0
 * @property EstadosEmocionais[] $estadosEmocionais1
 * @property GrupoUsuarios[] $grupoUsuarios
 * @property GrupoUsuarios[] $grupoUsuarios0
 * @property GrupoUsuariosHasUsuarios[] $grupoUsuariosHasUsuarios
 * @property GrupoUsuarios[] $idGrupoUsuarios
 * @property Mensagens[] $mensagens
 * @property Mensagens[] $mensagens0
 * @property PeriodosAfastamento[] $periodosAfastamentos
 * @property PeriodosAfastamento[] $periodosAfastamentos0
 * @property PeriodosAfastamento[] $periodosAfastamentos1
 * @property TiposUsuario $tipoUsuario
 * @property Usuarios $criadoPor
 * @property Usuarios[] $usuarios
 * @property Usuarios $modificadoPor
 * @property Usuarios[] $usuarios0
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_matricula', 'nome_completo', 'senha', 'tipo_usuario', 'criado_por'], 'required'],
            [['data_nasc', 'criado_em', 'modificado_em'], 'safe'],
            [['tipo_usuario', 'ativo', 'criado_por', 'modificado_por'], 'integer'],
            [['num_matricula', 'funcao', 'setor', 'foto'], 'string', 'max' => 45],
            [['nome_completo'], 'string', 'max' => 100],
            [['email', 'senha'], 'string', 'max' => 50],
            [['num_matricula'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'num_matricula' => 'Num Matricula',
            'nome_completo' => 'Nome Completo',
            'data_nasc' => 'Data Nasc',
            'funcao' => 'Funcao',
            'setor' => 'Setor',
            'foto' => 'Foto',
            'email' => 'Email',
            'senha' => 'Senha',
            'tipo_usuario' => 'Tipo Usuario',
            'ativo' => 'Ativo',
            'criado_por' => 'Criado Por',
            'criado_em' => 'Criado Em',
            'modificado_por' => 'Modificado Por',
            'modificado_em' => 'Modificado Em',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos()
    {
        return $this->hasMany(Avisos::className(), ['criado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvisos0()
    {
        return $this->hasMany(Avisos::className(), ['modificado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurtidas()
    {
        return $this->hasMany(Curtidas::className(), ['criado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurtidas0()
    {
        return $this->hasMany(Curtidas::className(), ['modificado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurtidas1()
    {
        return $this->hasMany(Curtidas::className(), ['usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadosEmocionais()
    {
        return $this->hasMany(EstadosEmocionais::className(), ['criado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadosEmocionais0()
    {
        return $this->hasMany(EstadosEmocionais::className(), ['modificado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadosEmocionais1()
    {
        return $this->hasMany(EstadosEmocionais::className(), ['usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoUsuarios()
    {
        return $this->hasMany(GrupoUsuarios::className(), ['criado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoUsuarios0()
    {
        return $this->hasMany(GrupoUsuarios::className(), ['modificado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoUsuariosHasUsuarios()
    {
        return $this->hasMany(GrupoUsuariosHasUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGrupoUsuarios()
    {
        return $this->hasMany(GrupoUsuarios::className(), ['id_grupo_usuarios' => 'id_grupo_usuarios'])->viaTable('grupo_usuarios_has_usuarios', ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensagens()
    {
        return $this->hasMany(Mensagens::className(), ['criado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensagens0()
    {
        return $this->hasMany(Mensagens::className(), ['destinatario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodosAfastamentos()
    {
        return $this->hasMany(PeriodosAfastamento::className(), ['criado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodosAfastamentos0()
    {
        return $this->hasMany(PeriodosAfastamento::className(), ['modificado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodosAfastamentos1()
    {
        return $this->hasMany(PeriodosAfastamento::className(), ['usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUsuario()
    {
        return $this->hasOne(TiposUsuario::className(), ['id_tipo_usuario' => 'tipo_usuario']);
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
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['criado_por' => 'id_usuario']);
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
    public function getUsuarios0()
    {
        return $this->hasMany(Usuarios::className(), ['modificado_por' => 'id_usuario']);
    }
}
