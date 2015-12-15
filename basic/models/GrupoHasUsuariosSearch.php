<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrupoHasUsuarios;

/**
 * GrupoHasUsuariosSearch represents the model behind the search form about `app\models\GrupoHasUsuarios`.
 */
class GrupoHasUsuariosSearch extends GrupoHasUsuarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_grupo_usuarios', 'id_usuario'], 'integer'],
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
        $query = GrupoHasUsuarios::find();

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
            'id_grupo_usuarios' => $this->id_grupo_usuarios,
            'id_usuario' => $this->id_usuario,
        ]);

        return $dataProvider;
    }
}
