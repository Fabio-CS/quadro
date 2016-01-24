<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Avisos;

/**
 * AvisosSearch represents the model behind the search form about `app\models\Avisos`.
 */
class AvisosSearch extends Avisos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_aviso', 'tempo_exibicao', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['titulo', 'descricao', 'imagem', 'data_inicio', 'data_fim', 'criado_em', 'modificado_em'], 'safe'],
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
        $query = Avisos::find();

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
            'id_aviso' => $this->id_aviso,
            'tempo_exibicao' => $this->tempo_exibicao,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'criado_por' => $this->criado_por,
            'criado_em' => $this->criado_em,
            'modificado_por' => $this->modificado_por,
            'modificado_em' => $this->modificado_em,
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'imagem', $this->imagem]);

        return $dataProvider;
    }
}
