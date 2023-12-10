<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estanteriapersonal;

/**
 * EstanteriapersonalSearch represents the model behind the search form of `app\models\Estanteriapersonal`.
 */
class EstanteriapersonalSearch extends Estanteriapersonal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estanteria_id', 'libro_id'], 'integer'],
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
        $query = Estanteriapersonal::find();

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
            'estanteria_id' => $this->estanteria_id,
            'libro_id' => $this->libro_id,
        ]);

        return $dataProvider;
    }
}
