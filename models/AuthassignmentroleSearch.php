<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Authassignmentrole;

/**
 * AuthassignmentroleSearch represents the model behind the search form of `app\models\Authassignmentrole`.
 */
class AuthassignmentroleSearch extends Authassignmentrole
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idusername', 'role_id'], 'integer'],
            [['Created_at', 'Updated_at'], 'safe'],
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
        $query = Authassignmentrole::find();

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
            'id' => $this->id,
            'idusername' => $this->idusername,
            'role_id' => $this->role_id,
            'Created_at' => $this->Created_at,
            'Updated_at' => $this->Updated_at,
        ]);

        return $dataProvider;
    }
}
