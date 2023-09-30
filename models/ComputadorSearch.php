<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Computador;

/**
 * ComputadorSearch represents the model behind the search form of `app\models\Computador`.
 */
class ComputadorSearch extends Computador
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pc'], 'integer'],
            [['pc_nombre', 'pc_estado'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Computador::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pc' => $this->id_pc,
        ]);

        $query->andFilterWhere(['like', 'pc_nombre', $this->pc_nombre])
            ->andFilterWhere(['like', 'pc_estado', $this->pc_estado]);

        return $dataProvider;
    }
}
