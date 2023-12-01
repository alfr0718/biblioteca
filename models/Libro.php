<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "libro".
 *
 * @property int $id
 * @property string $Titulo
 * @property string $Autor
 * @property string|null $Editorial
 * @property string|null $Anio
 * @property string|null $Isbn
 * @property string|null $N_clasificacion
 * @property string|null $Descripcion
 * @property int $Status
 * @property int $idcategoria
 * @property int $idpais
 * @property int $idasignatura
 * @property string|null $portada
 * @property string|null $doc
 *
 * @property Asignatura $idasignatura0
 * @property Categoria $idcategoria0
 * @property Pais $idpais0
 */
class Libro extends \yii\db\ActiveRecord
{
    public $portadaFile; // Atributo para la imagen
    public $docFile; // Atributo para el documento
    

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
            [['portadaFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['docFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['Titulo', 'Autor', 'idcategoria', 'idpais', 'idasignatura'], 'required'],
            [['Anio'], 'safe'],
            [['Status', 'idcategoria', 'idpais', 'idasignatura'], 'integer'],
            [['portada', 'doc'], 'string', 'max' => 255],
            [['Titulo', 'Autor', 'Editorial'], 'string', 'max' => 255],
            [['Isbn', 'N_clasificacion'], 'string', 'max' => 100],
            [['Descripcion'], 'string', 'max' => 1000],
            [['idasignatura'], 'exist', 'skipOnError' => true, 'targetClass' => Asignatura::class, 'targetAttribute' => ['idasignatura' => 'id']],
            [['idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['idcategoria' => 'id']],
            [['idpais'], 'exist', 'skipOnError' => true, 'targetClass' => Pais::class, 'targetAttribute' => ['idpais' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Titulo' => 'Título',
            'Autor' => 'Autor',
            'Editorial' => 'Editorial',
            'Anio' => 'Año',
            'Isbn' => 'ISBN',
            'N_clasificacion' => 'N° Clasificacion',
            'Descripcion' => 'Descripción',
            'Status' => 'Estado',
            'idcategoria' => 'Categoría',
            'idpais' => 'País',
            'idasignatura' => 'Asignatura',
            'portada' => 'Portada',
            'doc' => 'Documento',
            'portadaFile' => 'Portada',
            'docFile' => 'Archivo',

        ];
    }

    /**
     * Gets query for [[Idasignatura0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdasignatura0()
    {
        return $this->hasOne(Asignatura::class, ['id' => 'idasignatura']);
    }

    /**
     * Gets query for [[Idcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcategoria0()
    {
        return $this->hasOne(Categoria::class, ['id' => 'idcategoria']);
    }

    /**
     * Gets query for [[Idpais0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpais0()
    {
        return $this->hasOne(Pais::class, ['id' => 'idpais']);
    }
}
