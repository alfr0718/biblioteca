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
            [['codigo_barra', 'lib_cute', 'lib_isbn', 'lib_titulo', 'lib_autor', 'lib_editorial', 'lib_aniopulic'], 'safe'],
            [['n_ejemplares_libro', 'lib_num', 'lib_estado', 'paises_id_pais', 'asignatura_id_asignat', 'biblioteca_id_campus', 'categoria_id_categ'], 'integer'],
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
            'lib_num' => $this->lib_num,
            'lib_aniopulic' => $this->lib_aniopulic,
            'lib_estado' => $this->lib_estado,
            'paises_id_pais' => $this->paises_id_pais,
            'asignatura_id_asignat' => $this->asignatura_id_asignat,
            'biblioteca_id_campus' => $this->biblioteca_id_campus,
            'categoria_id_categ' => $this->categoria_id_categ,
        ]);

        $query->andFilterWhere(['like', 'codigo_barra', $this->codigo_barra])
            ->andFilterWhere(['like', 'lib_cute', $this->lib_cute])
            ->andFilterWhere(['like', 'lib_isbn', $this->lib_isbn])
            ->andFilterWhere(['like', 'lib_titulo', $this->lib_titulo])
            ->andFilterWhere(['like', 'lib_autor', $this->lib_autor])
            ->andFilterWhere(['like', 'lib_editorial', $this->lib_editorial]);

        return $dataProvider;
    }
}
