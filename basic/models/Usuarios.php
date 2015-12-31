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
 * @property string $confirmSenha
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
    public $senha_repeat;
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
            [['num_matricula', 'nome_completo', 'tipo_usuario'], 'required'],
            ['senha', 'required', 'on'=>'create'],
            ['senha_repeat', 'compare', 'compareAttribute'=>'senha', 'skipOnEmpty' => false, 'message'=>"Senhas não conferem", 'on' => 'create' ],
            [['data_nasc'], 'date', 'format' => 'yyyy-mm-dd'],
            [['tipo_usuario'], 'integer'],
            [['num_matricula', 'funcao', 'setor'], 'string', 'max' => 45],
            [['nome_completo'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['foto'], 'file', 'extensions' => 'png, jpg, jpeg, tif, tiff', 'mimeTypes' => 'image/jpeg, image/jpg, image/png, image/tif, image/tiff'],
            [['num_matricula'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'ID',
            'num_matricula' => 'Matrícula',
            'nome_completo' => 'Nome Completo',
            'data_nasc' => 'Data Nasc.',
            'funcao' => 'Função',
            'setor' => 'Setor',
            'foto' => 'Foto',
            'email' => 'E-mail',
            'senha' => 'Senha',
            'senha_repeat' => 'Confirme a senha',
            'tipo_usuario' => 'Tipo de Usuário',
            'ativo' => 'Ativo',
            'criado_por' => 'Criado Por',
            'criado_em' => 'Criado Em',
            'modificado_por' => 'Modificado Por',
            'modificado_em' => 'Modificado Em',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
            //password encryptation process
            $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->senha);
            // validadte if (Yii::$app->getSecurity()->validatePassword($password, $hash))
            return parent::beforeSave($insert);
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
