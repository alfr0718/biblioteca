<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libro".
 *
 * @property string $codigo_barra
 * @property int $n_ejemplares_libro
 * @property int $num
 * @property string $lib_asignatura
 * @property string $lib_isbn
 * @property string $lib_nombre
 * @property string $lib_categoria
 * @property string $lib_autor
 * @property string $lib_editorial
 * @property string $lib_pais
 * @property string $lib_anio
 * @property string|null $lib_duplicado
 * @property string|null $lib_estado
 *
 * @property Prestamo[] $prestamos
 */
class Libro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_barra', 'n_ejemplares_libro', 'num', 'lib_asignatura', 'lib_isbn', 'lib_nombre', 'lib_categoria', 'lib_autor', 'lib_editorial', 'lib_pais', 'lib_anio'], 'required'],
            [['n_ejemplares_libro', 'num'], 'integer'],
            [['lib_anio'], 'safe'],
            [['codigo_barra', 'lib_autor', 'lib_editorial', 'lib_estado'], 'string', 'max' => 100],
            [['lib_asignatura', 'lib_duplicado'], 'string', 'max' => 45],
            [['lib_isbn'], 'string', 'max' => 20],
            [['lib_nombre'], 'string', 'max' => 500],
            [['lib_categoria'], 'string', 'max' => 50],
            [['lib_pais'], 'string', 'max' => 60],
            [['codigo_barra'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codigo_barra' => 'Codigo Barra',
            'n_ejemplares_libro' => 'N Ejemplares Libro',
            'num' => 'Num',
            'lib_asignatura' => 'Lib Asignatura',
            'lib_isbn' => 'Lib Isbn',
            'lib_nombre' => 'Lib Nombre',
            'lib_categoria' => 'Lib Categoria',
            'lib_autor' => 'Lib Autor',
            'lib_editorial' => 'Lib Editorial',
            'lib_pais' => 'Lib Pais',
            'lib_anio' => 'Lib Anio',
            'lib_duplicado' => 'Lib Duplicado',
            'lib_estado' => 'Lib Estado',
        ];
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::class, ['libro_codigo_barra' => 'codigo_barra']);
    }
}
