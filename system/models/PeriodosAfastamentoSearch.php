<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PeriodosAfastamento;

/**
 * PeriodosAfastamentoSearch represents the model behind the search form about `app\models\PeriodosAfastamento`.
 */
class PeriodosAfastamentoSearch extends PeriodosAfastamento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_periodo_afastamento', 'id_usuario', 'id_tipo_afastamento', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['data_inicio', 'data_fim', 'criado_em', 'modificado_em'], 'safe'],
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
        $query = PeriodosAfastamento::find();

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
            'id_periodo_afastamento' => $this->id_periodo_afastamento,
            'id_usuario' => $this->id_usuario,
            'id_tipo_afastamento' => $this->id_tipo_afastamento,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'criado_por' => $this->criado_por,
            'criado_em' => $this->criado_em,
            'modificado_por' => $this->modificado_por,
            'modificado_em' => $this->modificado_em,
            'ativo' => 1,
        ]);

        return $dataProvider;
    }
}
