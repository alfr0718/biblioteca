<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personacarrera".
 *
 * @property int $datospersonales_id
 * @property int $carrera_idfac
 *
 * @property Carrera $carreraIdfac
 * @property Datospersonales $datospersonales
 */
class Personacarrera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personacarrera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datospersonales_id', 'carrera_idfac'], 'required'],
            [['datospersonales_id', 'carrera_idfac'], 'integer'],
            [['datospersonales_id', 'carrera_idfac'], 'unique', 'targetAttribute' => ['datospersonales_id', 'carrera_idfac']],
            [['carrera_idfac'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::class, 'targetAttribute' => ['carrera_idfac' => 'idcar']],
            [['datospersonales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Datospersonales::class, 'targetAttribute' => ['datospersonales_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'datospersonales_id' => 'Datospersonales ID',
            'carrera_idfac' => 'Carrera Idfac',
        ];
    }

    /**
     * Gets query for [[CarreraIdfac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreraIdfac()
    {
        return $this->hasOne(Carrera::class, ['idcar' => 'carrera_idfac']);
    }

    /**
     * Gets query for [[Datospersonales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDatospersonales()
    {
        return $this->hasOne(Datospersonales::class, ['id' => 'datospersonales_id']);
    }
}
