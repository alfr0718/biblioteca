<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Datospersonales;

/**
 * DatospersonalesSearch represents the model behind the search form of `app\models\Datospersonales`.
 */
class DatospersonalesSearch extends Datospersonales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Status'], 'integer'],
            [['Ci', 'ApellidoMaterno', 'ApellidoPaterno', 'Nombres', 'Email'], 'safe'],
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
        $query = Datospersonales::find();

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
            'Status' => $this->Status,
        ]);

        $query->andFilterWhere(['like', 'Ci', $this->Ci])
            ->andFilterWhere(['like', 'ApellidoMaterno', $this->ApellidoMaterno])
            ->andFilterWhere(['like', 'ApellidoPaterno', $this->ApellidoPaterno])
            ->andFilterWhere(['like', 'Nombres', $this->Nombres])
            ->andFilterWhere(['like', 'Email', $this->Email]);

        return $dataProvider;
    }
}
