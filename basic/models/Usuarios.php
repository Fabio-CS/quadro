<?php

namespace app\models;
use yii\web\UploadedFile;
use app\components\validators\SenhaValidator;
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
 */
class Usuarios extends \yii\db\ActiveRecord
{
    public $senha_repeat;
    public $oldPassword;
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
            [['senha', 'senha_repeat'], 'required', 'on'=>'create'],
            ['senha_repeat', 'compare', 'compareAttribute'=>'senha', 'message'=>"Senhas não conferem", 'on' => 'create' ],
            [['data_nasc'], 'date', 'format' => 'yyyy-mm-dd'],
            [['tipo_usuario'], 'integer'],
            [['num_matricula', 'funcao', 'setor'], 'string', 'max' => 45],
            [['nome_completo'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['foto'], 'file', 'extensions' => 'png, jpg, jpeg, tif, tiff', 'mimeTypes' => 'image/jpeg, image/jpg, image/png, image/tif, image/tiff'],
            [['num_matricula'], 'unique'],
            ['senha_repeat', SenhaValidator::className(), 'on' => 'update']
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
            if(!empty($this->senha_repeat)){
                //password encryptation process
                $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->senha);
            }
            // validadte if (Yii::$app->getSecurity()->validatePassword($password, $hash))
            return parent::beforeSave($insert);
    }
    
    /**
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile() 
    {
        return isset($this->foto) ? Yii::$app->params['uploadPath'] . $this->foto : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() 
    {
        // return a default image placeholder if your source avatar is not found
        $image = isset($this->foto) ? $this->foto : 'default_user.jpg';
        return Yii::$app->params['uploadUrl'] . $image;
    }

    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'foto');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->foto = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }

    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->foto = null;

        return true;
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurtidas()
    {
        return $this->hasMany(Curtidas::className(), ['usuario' => 'id_usuario']);
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
    public function getMensagensEnviadas()
    {
        return $this->hasMany(Mensagens::className(), ['criado_por' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensagensRecebidas()
    {
        return $this->hasMany(Mensagens::className(), ['destinatario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodosAfastamentos()
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
}
