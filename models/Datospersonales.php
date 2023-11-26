<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datospersonales".
 *
 * @property int $id
 * @property string $Ci
 * @property string $ApellidoMaterno
 * @property string|null $ApellidoPaterno
 * @property string $Nombres
 * @property string $Email
 * @property int $Status
 *
 * @property Carrera[] $carreraIdfacs
 * @property Personacarrera[] $personacarreras
 */
class Datospersonales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datospersonales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Ci', 'ApellidoMaterno', 'Nombres', 'Email'], 'required'],
            [['Status'], 'integer'],
            [['Ci'], 'string', 'max' => 15],
            [['ApellidoMaterno'], 'string', 'max' => 40],
            [['ApellidoPaterno', 'Nombres', 'Email'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Ci' => 'Ci',
            'ApellidoPaterno' => 'Apellido Paterno',
            'ApellidoMaterno' => 'Apellido Materno',
            'Nombres' => 'Nombres',
            'Email' => 'Email',
            'Status' => 'Status',
        ];
    }

    /**
     * Gets query for [[CarreraIdfacs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarreraIdfacs()
    {
        return $this->hasMany(Carrera::class, ['idcar' => 'carrera_idfac'])->viaTable('personacarrera', ['datospersonales_id' => 'id']);
    }

    /**
     * Gets query for [[Personacarreras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPersonacarreras()
    {
        return $this->hasMany(Personacarrera::class, ['datospersonales_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['username' => 'Ci']);
    }

    /**
     * Encuentra un modelo basado en el número de cédula.
     * @param string $cedula El número de cédula para buscar.
     * @return static|null El modelo encontrado o null si no se encuentra.
     */
    public static function findByCedula($cedula)
    {
        return static::findOne(['Ci' => $cedula]);
    }
    public function getNombreCompleto()
    {
        return $this->Nombres . ' ' . $this->ApellidoPaterno . ' ' . $this->ApellidoMaterno;
    }
}
