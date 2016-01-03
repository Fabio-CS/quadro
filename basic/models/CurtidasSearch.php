<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Curtidas;

/**
 * CurtidasSearch represents the model behind the search form about `app\models\Curtidas`.
 */
class CurtidasSearch extends Curtidas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_curtida', 'usuario', 'criado_por', 'modificado_por', 'ativo'], 'integer'],
            [['motivo', 'criado_em', 'modificado_em'], 'safe'],
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
        $query = Curtidas::find();

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
            'id_curtida' => $this->id_curtida,
            'usuario' => $this->usuario,
            'criado_por' => $this->criado_por,
            'criado_em' => $this->criado_em,
            'modificado_por' => $this->modificado_por,
            'modificado_em' => $this->modificado_em,
            'ativo' => 1,
        ]);

        $query->andFilterWhere(['like', 'motivo', $this->motivo]);

        return $dataProvider;
    }
}
