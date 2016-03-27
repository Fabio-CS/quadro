<?php

namespace app\models;
use yii\web\UploadedFile;
use app\components\validators\SenhaValidator;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
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
class Usuarios extends ActiveRecord implements IdentityInterface
{
    public $password_repeat;
    public $password;
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
            [['num_matricula', 'nome_completo', 'id_tipo_usuario'], 'required'],
            [['password', 'password_repeat'], 'required', 'on'=>'create'],
            ['password', 'string', 'min' => 5],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Senhas não conferem", 'on' => 'create' ],
            [['data_nasc'], 'date', 'format' => 'yyyy-mm-dd'],
            [['id_tipo_usuario'], 'integer'],
            [['num_matricula', 'funcao', 'setor'], 'string', 'max' => 45],
            [['nome_completo'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['foto'], 'file', 'extensions' => 'png, jpg, jpeg, tif, tiff', 'mimeTypes' => 'image/jpeg, image/jpg, image/png, image/tif, image/tiff'],
            ['password', SenhaValidator::className(), 'skipOnEmpty' => 'true', 'on' => 'update'],
            ['password_repeat', SenhaValidator::className(), 'skipOnEmpty' => 'true', 'on' => 'update']
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
            'password' => 'Senha',
            'password_repeat' => 'Confirme a senha',
            'id_tipo_usuario' => 'Tipo de Usuário',
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
            if ($this->getIsNewRecord()){
                $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }else if(isset($this->password) && !empty($this->password)){
                //password encryptation process
                $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }else{
                unset($this->senha);
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
        return isset($this->foto) && !empty($this->foto) ? Yii::$app->params['uploadPath'] . $this->foto : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() 
    {
        // return a default image placeholder if your source avatar is not found
        $image = isset($this->foto) && !empty($this->foto) ? $this->foto : 'default_user.png';
        return Yii::$app->params['uploadPath'] . $image;
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
        return $this->hasMany(Curtidas::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadosEmocionais()
    {
        return $this->hasMany(EstadosEmocionais::className(), ['id_usuario' => 'id_usuario']);
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
        return $this->hasMany(PeriodosAfastamento::className(), ['id_usuario' => 'id_usuario']);
    }
    
    /**
     * @return \yii\models\PeriodosAfastamentos
     * Retorna os períodos de afastamentos ativos
     */
    public function getActivePeriodosAfastamentos(){
       $arrayAvisos = Yii::$app->db->createCommand("SELECT * FROM `periodos_afastamento` where `data_fim` >= cast(now() as date) and `data_inicio` <= cast(now() as date) and `ativo` = 1 and id_usuario = $this->id_usuario order by id_periodo_afastamento DESC limit 1")->queryAll();
       $periodo = false;
       foreach ($arrayAvisos as $key => $value) {
           $periodo = new PeriodosAfastamento();
           $periodo->id_periodo_afastamento = $value['id_periodo_afastamento'];
           $periodo->id_usuario = $value['id_usuario'];
           $periodo->id_tipo_afastamento = $value['id_tipo_afastamento'];
           $periodo->data_inicio = $value['data_inicio'];
           $periodo->data_fim = $value['data_fim'];
       }
           return $periodo;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUsuario()
    {
        return $this->hasOne(TiposUsuario::className(), ['id_tipo_usuario' => 'id_tipo_usuario']);
    }
    
    /**
     * Encontrar o usuário pelo número de matrícula
     * @return Usuario Informações do usuário do banco de dados.
     */
     public static function findByMatricula($matricula){
         return Usuarios::find()->where(['num_matricula' => $matricula, 'ativo' => 1])->one();
     }
     
     /**
      * Validar senha de acordo com o usuário informado.
      * @return boolean True se a senha está correta.
      */
     public function validatePassword($password){
         if (Yii::$app->getSecurity()->validatePassword($password, $this->senha)){
             return true;
         }else{
             return false;
         }
     }

     public function isAdmin(){
         if($this->tipoUsuario->nome === Yii::$app->params['Admin']){
             return true;
         }
         return false;
     }
     
     public function isDev(){
         if($this->tipoUsuario->nome === Yii::$app->params['Dev']){
             return true;
         }
         return false;
     }
     
     public function isColab(){
         if($this->tipoUsuario->nome === Yii::$app->params['Colab']){
             return true;
         }
         return false;
     }
     
     public function isBirthday(){
         $birthday = $this->data_nasc;
         if(date('m-d') == substr($birthday,5,5) or (date('y')%4 <> 0 and substr($birthday,5,5)=='02-29' and date('m-d')=='02-28')){
             return true;
         }else{
             return false;
         }
     }
     
     public function getEstadoEmocionalPrincipal(){
         $estadoEmocional = $this->getEstadosEmocionais()->where(['ativo' => 1, 'data' => date('Y-m-d'), 'criado_por' => $this->id_usuario ])->addOrderBy(["id_estado_emocional" => SORT_DESC])->one();
         return $estadoEmocional;    
     }
     
     public function getEstadoEmocionalSecundario(){
         $estadoEmocional = $this->getEstadosEmocionais()->where(['ativo' => 1, 'data' => date('Y-m-d')])->andWhere(['not', ['criado_por' => $this->id_usuario]])->addOrderBy(["id_estado_emocional" => SORT_DESC])->one();
         return $estadoEmocional;
     }
     
     public function getDisplayName(){
        $r = explode(' ', $this->nome_completo);
	$first = reset($r);
	$last = end($r);
	return $first." ".$last;
     }
     
     public function getMenu(){
         if($this->isAdmin()){
             return ['site/menu-admin'];
         }else if($this->isColab()){
             return ['site/menu-colaborador'];
         }else if($this->isDev()){
             return ['site/menu-developer'];
         }
         return ['site/index'];
     }
     
     public static function getAdminsEmails(){
        $usuarios = Usuarios::find()->innerJoinWith('tipoUsuario')->where(["usuarios.ativo" => 1])->andWhere(["tipos_usuario.nome" => Yii::$app->params['Admin']])->all();
        $emails = array();
        foreach ($usuarios as $usuario) {
            $emails[$usuario->email] = $usuario->nome_completo;
        }
        return $emails;    
     }
     
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotalCurtidasMes()
    {
        $curtidas = $this->hasMany(Curtidas::className(), ['id_usuario' => 'id_usuario'])->where(['ativo' => 1])->all();
        $totalMes = 0;
        $esteMes = date("m-Y");
        foreach ($curtidas as $curtida){
            $criado_em = date_format(date_create($curtida->criado_em), "m-Y");
            if ($criado_em == $esteMes){
                $totalMes++;
            }
        }
        return $totalMes;
    }
     
     /**
     * Identity Interface Implementation
     */
    
    public function getAuthKey() {
        
    }
    
    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->id_usuario;
    }

    public function validateAuthKey($authKey) {
        
    }
    
    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        
    }

}
