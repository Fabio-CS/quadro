<?php

namespace app\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "avisos".
 *
 * @property integer $id_aviso
 * @property string $titulo
 * @property string $descricao
 * @property file $imagem
 * @property integer $tempo_exibicao
 * @property string $data_inicio
 * @property string $data_fim
 * @property integer $criado_por
 * @property string $criado_em
 * @property integer $modificado_por
 * @property string $modificado_em
 * @property integer $ativo
 *
 * @property Usuarios $criadoPor
 * @property Usuarios $modificadoPor
 */
class Avisos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'avisos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'tempo_exibicao', 'data_inicio', 'data_fim'], 'required', 'on' => 'create'],
            [['titulo', 'tempo_exibicao', 'data_inicio', 'data_fim'], 'required', 'on' => 'update'],
            [['tempo_exibicao'], 'integer'],
            [['data_inicio', 'data_fim'], 'date', 'format' => 'yyyy-mm-dd'],
            [['titulo'], 'string', 'max' => 100],
            [['imagem'], 'file', 'extensions' => 'png, jpg, jpeg, tif, tiff', 'mimeTypes' => 'image/jpeg, image/jpg, image/png, image/tif, image/tiff'],
            [['descricao'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_aviso' => 'ID',
            'titulo' => 'Título',
            'descricao' => 'Descrição',
            'imagem' => 'Imagem',
            'tempo_exibicao' => 'Tempo de exibição',
            'data_inicio' => 'Data inicial de exibição',
            'data_fim' => 'Data final de exibição',
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
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile() 
    {
        return isset($this->imagem) ? Yii::$app->params['uploadPath'] . $this->imagem : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() 
    {
        // return a default image placeholder if your source avatar is not found
        $image = isset($this->imagem) ? $this->imagem : null;
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
        $image = UploadedFile::getInstance($this, 'imagem');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->imagem = Yii::$app->security->generateRandomString().".{$ext}";

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
}
