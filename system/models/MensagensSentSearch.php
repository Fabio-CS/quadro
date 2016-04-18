<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mensagens;

/**
 * MensagensSearch represents the model behind the search form about `app\models\Mensagens`.
 */
class MensagensSentSearch extends Mensagens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mensagem', 'destinatario', 'resposta_de', 'criado_por', 'ativo'], 'integer'],
            [['texto', 'lida', 'criado_em', 'assunto'], 'safe'],
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
            'sort'=> ['defaultOrder' => ['criado_em'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_mensagem' => $this->id_mensagem,
            'id_destinatario' => $this->id_destinatario,
            'lida' => $this->lida,
            'resposta_de' => $this->resposta_de,
            'criado_por' => Yii::$app->user->getId(),
            'criado_em' => $this->criado_em,
            'ativo' => 1,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto]);
        $query->andFilterWhere(['like', 'assunto', $this->assunto]);

        return $dataProvider;
    }
}
