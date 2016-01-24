<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_afastamento".
 *
 * @property integer $id_tipo_afastamento
 * @property string $nome
 * @property integer $ativo
 *
 * @property PeriodosAfastamento[] $periodosAfastamentos
 */
class TiposAfastamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_afastamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ativo'], 'integer'],
            [['nome'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_afastamento' => 'Id Tipo Afastamento',
            'nome' => 'Nome',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodosAfastamentos()
    {
        return $this->hasMany(PeriodosAfastamento::className(), ['tipo_afastamento' => 'id_tipo_afastamento']);
    }
}
