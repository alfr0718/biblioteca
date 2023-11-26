<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asignatura".
 *
 * @property int $id
 * @property string $Nombre
 * @property int $idcar
 *
 * @property Carrera $idcar0
 * @property Libro[] $libros
 */
class Asignatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre', 'idcar'], 'required'],
            [['idcar'], 'integer'],
            [['Nombre'], 'string', 'max' => 100],
            [['idcar'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::class, 'targetAttribute' => ['idcar' => 'idcar']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Nombre' => 'Nombre',
            'idcar' => 'Carrera',
        ];
    }

    /**
     * Gets query for [[Idcar0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcar0()
    {
        return $this->hasOne(Carrera::class, ['idcar' => 'idcar']);
    }

    /**
     * Gets query for [[Libros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libro::class, ['idasignatura' => 'id']);
    }
}
