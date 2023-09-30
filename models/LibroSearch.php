<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Libro;

/**
 * LibroSearch represents the model behind the search form of `app\models\Libro`.
 */
class LibroSearch extends Libro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_barra', 'lib_asignatura', 'lib_isbn', 'lib_nombre', 'lib_categoria', 'lib_autor', 'lib_editorial', 'lib_pais', 'lib_anio', 'lib_duplicado', 'lib_estado'], 'safe'],
            [['n_ejemplares_libro', 'num'], 'integer'],
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
        $query = Libro::find();

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
            'n_ejemplares_libro' => $this->n_ejemplares_libro,
            'num' => $this->num,
            'lib_anio' => $this->lib_anio,
        ]);

        $query->andFilterWhere(['like', 'codigo_barra', $this->codigo_barra])
            ->andFilterWhere(['like', 'lib_asignatura', $this->lib_asignatura])
            ->andFilterWhere(['like', 'lib_isbn', $this->lib_isbn])
            ->andFilterWhere(['like', 'lib_nombre', $this->lib_nombre])
            ->andFilterWhere(['like', 'lib_categoria', $this->lib_categoria])
            ->andFilterWhere(['like', 'lib_autor', $this->lib_autor])
            ->andFilterWhere(['like', 'lib_editorial', $this->lib_editorial])
            ->andFilterWhere(['like', 'lib_pais', $this->lib_pais])
            ->andFilterWhere(['like', 'lib_duplicado', $this->lib_duplicado])
            ->andFilterWhere(['like', 'lib_estado', $this->lib_estado]);

        return $dataProvider;
    }
}
