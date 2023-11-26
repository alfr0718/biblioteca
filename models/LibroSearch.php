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
            [['id', 'Status', 'idcategoria', 'idpais', 'idasignatura'], 'integer'],
            [['Titulo', 'Autor', 'Editorial', 'Anio', 'Isbn', 'N_clasificacion', 'Descripcion', 'portada', 'doc'], 'safe'],
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
            'id' => $this->id,
            'Anio' => $this->Anio,
            'Status' => $this->Status,
            'idcategoria' => $this->idcategoria,
            'idpais' => $this->idpais,
            'idasignatura' => $this->idasignatura,
        ]);

        $query->andFilterWhere(['like', 'Titulo', $this->Titulo])
            ->andFilterWhere(['like', 'Autor', $this->Autor])
            ->andFilterWhere(['like', 'Editorial', $this->Editorial])
            ->andFilterWhere(['like', 'Isbn', $this->Isbn])
            ->andFilterWhere(['like', 'N_clasificacion', $this->N_clasificacion])
            ->andFilterWhere(['like', 'Descripcion', $this->Descripcion])
            ->andFilterWhere(['like', 'portada', $this->portada])
            ->andFilterWhere(['like', 'doc', $this->doc]);

        if (!empty(array_filter($this->attributes))) {
            // Crea una instancia de Transaccion aquí
            $transaccion = new Transaccion();

            // Configura los atributos de la transacción según tus necesidades
            $transaccion->user_id = \Yii::$app->user->isGuest ? 0 : \Yii::$app->user->id;
            $transaccion->action = 'search';
            $transaccion->nombre_tabla = 'libro';

            // Guarda la transacción
            $transaccion->save();
        }

        return $dataProvider;
    }
}
