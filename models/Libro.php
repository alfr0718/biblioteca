<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libro".
 *
 * @property string $codigo_barra
 * @property int $n_ejemplares_libro
 * @property string $lib_cute
 * @property int $lib_num
 * @property string $lib_isbn
 * @property string $lib_titulo
 * @property string $lib_autor
 * @property string $lib_editorial
 * @property string $lib_aniopulic
 * @property int $lib_estado
 * @property int $paises_id_pais
 * @property int $asignatura_id_asignat
 * @property int $biblioteca_id_campus
 * @property int $categoria_id_categ
 *
 * @property Asignatura $asignaturaIdAsignat
 * @property Biblioteca $bibliotecaIdCampus
 * @property Categoria $categoriaIdCateg
 * @property Pais $paisesIdPais
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
            [['codigo_barra', 'n_ejemplares_libro', 'lib_cute', 'lib_num', 'lib_isbn', 'lib_titulo', 'lib_autor', 'lib_editorial', 'lib_aniopulic', 'lib_estado', 'paises_id_pais', 'asignatura_id_asignat', 'biblioteca_id_campus', 'categoria_id_categ'], 'required'],
            [['n_ejemplares_libro', 'lib_num', 'lib_estado', 'paises_id_pais', 'asignatura_id_asignat', 'biblioteca_id_campus', 'categoria_id_categ'], 'integer'],
            [['lib_aniopulic'], 'safe'],
            [['codigo_barra', 'lib_cute', 'lib_autor', 'lib_editorial'], 'string', 'max' => 100],
            [['lib_isbn'], 'string', 'max' => 20],
            [['lib_titulo'], 'string', 'max' => 500],
            [['codigo_barra'], 'unique'],
            [['asignatura_id_asignat'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::class, 'targetAttribute' => ['asignatura_id_asignat' => 'id_asignat']],
            [['biblioteca_id_campus'], 'exist', 'skipOnError' => true, 'targetClass' => Biblioteca::class, 'targetAttribute' => ['biblioteca_id_campus' => 'id_campus']],
            [['categoria_id_categ'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['categoria_id_categ' => 'id_categ']],
            [['paises_id_pais'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::class, 'targetAttribute' => ['paises_id_pais' => 'id_pais']],
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
            'lib_cute' => 'Lib Cute',
            'lib_num' => 'Lib Num',
            'lib_isbn' => 'Lib Isbn',
            'lib_titulo' => 'Lib Titulo',
            'lib_autor' => 'Lib Autor',
            'lib_editorial' => 'Lib Editorial',
            'lib_aniopulic' => 'Lib Aniopulic',
            'lib_estado' => 'Lib Estado',
            'paises_id_pais' => 'Paises Id Pais',
            'asignatura_id_asignat' => 'Asignatura Id Asignat',
            'biblioteca_id_campus' => 'Biblioteca Id Campus',
            'categoria_id_categ' => 'Categoria Id Categ',
        ];
    }

    /**
     * Gets query for [[AsignaturaIdAsignat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignaturaIdAsignat()
    {
        return $this->hasOne(Asignatura::class, ['id_asignat' => 'asignatura_id_asignat']);
    }

    /**
     * Gets query for [[BibliotecaIdCampus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBibliotecaIdCampus()
    {
        return $this->hasOne(Biblioteca::class, ['id_campus' => 'biblioteca_id_campus']);
    }

    /**
     * Gets query for [[CategoriaIdCateg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaIdCateg()
    {
        return $this->hasOne(Categoria::class, ['id_categ' => 'categoria_id_categ']);
    }

    /**
     * Gets query for [[PaisesIdPais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaisesIdPais()
    {
        return $this->hasOne(Pais::class, ['id_pais' => 'paises_id_pais']);
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
