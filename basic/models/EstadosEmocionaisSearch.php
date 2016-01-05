<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadosEmocionais;

/**
 * EstadosEmocionaisSearch represents the model behind the search form about `app\models\EstadosEmocionais`.
 */
class EstadosEmocionaisSearch extends EstadosEmocionais
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_estado_emocional', 'tipo_estado_emocional', 'usuario', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['data', 'criado_em', 'modificado_em'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EstadosEmocionais::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_estado_emocional' => $this->id_estado_emocional,
            'tipo_estado_emocional' => $this->tipo_estado_emocional,
            'usuario' => $this->usuario,
            'data' => $this->data,
            'criado_por' => $this->criado_por,
            'criado_em' => $this->criado_em,
            'modificado_por' => $this->modificado_por,
            'modificado_em' => $this->modificado_em,
            'ativo' => 1,
        ]);

        return $dataProvider;
    }
}
