<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;

/**
 * UsuariosSearch represents the model behind the search form about `app\models\Usuarios`.
 */
class UsuariosSearch extends Usuarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'tipo_usuario', 'ativo', 'criado_por', 'modificado_por'], 'integer'],
            [['num_matricula', 'nome_completo', 'data_nasc', 'funcao', 'setor', 'foto', 'email', 'senha', 'criado_em', 'modificado_em'], 'safe'],
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
        $query = Usuarios::find();

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
            'id_usuario' => $this->id_usuario,
            'data_nasc' => $this->data_nasc,
            'tipo_usuario' => $this->tipo_usuario,
            'ativo' => 1,
            'criado_por' => $this->criado_por,
            'criado_em' => $this->criado_em,
            'modificado_por' => $this->modificado_por,
            'modificado_em' => $this->modificado_em,
        ]);

        $query->andFilterWhere(['like', 'num_matricula', $this->num_matricula])
            ->andFilterWhere(['like', 'nome_completo', $this->nome_completo])
            ->andFilterWhere(['like', 'funcao', $this->funcao])
            ->andFilterWhere(['like', 'setor', $this->setor])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'senha', $this->senha]);

        return $dataProvider;
    }
}
