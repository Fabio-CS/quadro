<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avisos".
 *
 * @property integer $id_aviso
 * @property string $titulo
 * @property string $descricao
 * @property string $imagem
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
            [['titulo', 'imagem', 'tempo_exibicao', 'data_inicio', 'data_fim', 'criado_por'], 'required'],
            [['tempo_exibicao', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['data_inicio', 'data_fim', 'criado_em', 'modificado_em'], 'safe'],
            [['titulo', 'imagem'], 'string', 'max' => 100],
            [['descricao'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_aviso' => 'Id Aviso',
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
            'imagem' => 'Imagem',
            'tempo_exibicao' => 'Tempo Exibicao',
            'data_inicio' => 'Data Inicio',
            'data_fim' => 'Data Fim',
            'criado_por' => 'Criado Por',
            'criado_em' => 'Criado Em',
            'modificado_por' => 'Modificado Por',
            'modificado_em' => 'Modificado Em',
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
}
