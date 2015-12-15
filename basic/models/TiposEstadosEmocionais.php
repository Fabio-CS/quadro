<?php

namespace app\models;

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
            [['ativo'], 'integer'],
            [['nome', 'icone'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_estado_emocional' => 'Id Tipo Estado Emocional',
            'nome' => 'Nome',
            'icone' => 'Icone',
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
}
