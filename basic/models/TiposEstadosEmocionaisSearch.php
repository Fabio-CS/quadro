<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TiposEstadosEmocionais;

/**
 * TiposEstadosEmocionaisSearch represents the model behind the search form about `app\models\TiposEstadosEmocionais`.
 */
class TiposEstadosEmocionaisSearch extends TiposEstadosEmocionais
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_estado_emocional', 'ativo'], 'integer'],
            [['nome', 'icone'], 'safe'],
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
        $query = TiposEstadosEmocionais::find();

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
            'id_tipo_estado_emocional' => $this->id_tipo_estado_emocional,
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'icone', $this->icone]);

        return $dataProvider;
    }
}
