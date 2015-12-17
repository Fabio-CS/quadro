<?php

namespace app\models;

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
            [['titulo', 'imagem', 'tempo_exibicao', 'data_inicio', 'data_fim', 'criado_por'], 'required'],
            [['tempo_exibicao', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['data_inicio', 'data_fim', 'criado_em', 'modificado_em'], 'date'],
            [['titulo'], 'string', 'max' => 100],
            [['imagem'], 'file'],
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
}
