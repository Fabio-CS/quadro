<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "periodos_afastamento".
 *
 * @property integer $id_periodo_afastamento
 * @property integer $usuario
 * @property integer $tipo_afastamento
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
 * @property TiposAfastamento $tipoAfastamento
 * @property Usuarios $usuario0
 */
class PeriodosAfastamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'periodos_afastamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'tipo_afastamento', 'data_inicio', 'data_fim', 'criado_por'], 'required'],
            [['usuario', 'tipo_afastamento', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['data_inicio', 'data_fim', 'criado_em', 'modificado_em'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_periodo_afastamento' => 'Id Periodo Afastamento',
            'usuario' => 'Usuario',
            'tipo_afastamento' => 'Tipo Afastamento',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAfastamento()
    {
        return $this->hasOne(TiposAfastamento::className(), ['id_tipo_afastamento' => 'tipo_afastamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id_usuario' => 'usuario']);
    }
}
