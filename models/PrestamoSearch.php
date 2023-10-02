<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamo;

/**
 * PrestamoSearch represents the model behind the search form of `app\models\Prestamo`.
 */
class PrestamoSearch extends Prestamo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'biblioteca_idbiblioteca', 'pc_biblioteca_idbiblioteca', 'libro_biblioteca_idbiblioteca'], 'integer'],
            [['fecha_pedido', 'tiempo_solicitado', 'tipoprestamo_id', 'pc_idpc', 'libro_codigo_barras'], 'safe'],
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
        $query = Prestamo::find();

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
            'fecha_pedido' => $this->fecha_pedido,
            'tiempo_solicitado' => $this->tiempo_solicitado,
            'user_id' => $this->user_id,
            'biblioteca_idbiblioteca' => $this->biblioteca_idbiblioteca,
            'pc_biblioteca_idbiblioteca' => $this->pc_biblioteca_idbiblioteca,
            'libro_biblioteca_idbiblioteca' => $this->libro_biblioteca_idbiblioteca,
        ]);

        $query->andFilterWhere(['like', 'tipoprestamo_id', $this->tipoprestamo_id])
            ->andFilterWhere(['like', 'pc_idpc', $this->pc_idpc])
            ->andFilterWhere(['like', 'libro_codigo_barras', $this->libro_codigo_barras]);

        return $dataProvider;
    }
}
