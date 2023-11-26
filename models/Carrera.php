<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property int $idcar
 * @property string $Nombre
 * @property int $Status
 *
 * @property Asignatura[] $asignaturas
 * @property Datospersonales[] $datospersonales
 * @property Personacarrera[] $personacarreras
 */
class Carrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre'], 'required'],
            [['Status'], 'integer'],
            [['Nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcar' => 'ID',
            'Nombre' => 'Nombre',
            'Status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Asignaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignaturas()
    {
        return $this->hasMany(Asignatura::class, ['idcar' => 'idcar']);
    }

    /**
     * Gets query for [[Datospersonales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatospersonales()
    {
        return $this->hasMany(Datospersonales::class, ['id' => 'datospersonales_id'])->viaTable('personacarrera', ['carrera_idfac' => 'idcar']);
    }

    /**
     * Gets query for [[Personacarreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonacarreras()
    {
        return $this->hasMany(Personacarrera::class, ['carrera_idfac' => 'idcar']);
    }
}
