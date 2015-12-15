<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mensagens;

/**
 * MensagensSearch represents the model behind the search form about `app\models\Mensagens`.
 */
class MensagensSearch extends Mensagens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mensagem', 'destinatario', 'resposta_de', 'criado_por', 'ativo'], 'integer'],
            [['texto', 'lida', 'criado_em'], 'safe'],
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
        $query = Mensagens::find();

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
            'id_mensagem' => $this->id_mensagem,
            'destinatario' => $this->destinatario,
            'lida' => $this->lida,
            'resposta_de' => $this->resposta_de,
            'criado_por' => $this->criado_por,
            'criado_em' => $this->criado_em,
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
}
