<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;


/**
 * This is the model class for table "tipos_estados_emocionais".
 *
 * @property integer $id_tipo_estado_emocional
 * @property string $nome
 * @property string $icone
 * @property integer $ativo
 *
 * @property EstadosEmocionais[] $estadosEmocionais
 */
class TiposEstadosEmocionais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_estados_emocionais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'icone'], 'required', 'on' => 'create'],
            [['nome'], 'required', 'on' => 'update'],
            [['nome'], 'string', 'max' => 45],
            [['privado'], 'integer'],
            [['icone'], 'file', 'extensions' => 'png, jpg, jpeg, tif, tiff', 'mimeTypes' => 'image/jpeg, image/jpg, image/png, image/tif, image/tiff']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_estado_emocional' => 'ID',
            'nome' => 'Nome',
            'icone' => 'Ícone',
            'privado' => 'Visibilidade',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadosEmocionais()
    {
        return $this->hasMany(EstadosEmocionais::className(), ['tipo_estado_emocional' => 'id_tipo_estado_emocional']);
    }
    
    /**
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile() 
    {
        return isset($this->icone) ? Yii::$app->params['uploadPath'] . $this->icone : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() 
    {
        return Yii::$app->params['uploadPath'] . $this->icone;
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
        $image = UploadedFile::getInstance($this, 'icone');
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->icone = Yii::$app->security->generateRandomString().".{$ext}";

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
        $this->icone = null;

        return true;
    }
}
