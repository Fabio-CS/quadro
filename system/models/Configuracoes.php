<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuracoes".
 *
 * @property integer $id
 * @property string $nome
 * @property string $valor
 */
class Configuracoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'configuracoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'valor'], 'required'],
            [['nome', 'valor'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'valor' => 'Valor',
        ];
    }
}
