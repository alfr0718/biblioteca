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
 * @property string|null $Email
 * @property int $Status
 * @property string|null $Foto
 *
 * @property Carrera[] $carreraIdfacs
 * @property Personacarrera[] $personacarreras
 */
class Datospersonales extends \yii\db\ActiveRecord
{
    
    public $photofile;

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
            [['photofile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['Foto'], 'string', 'max' => 200],
            [['Ci', 'ApellidoPaterno', 'ApellidoMaterno', 'Nombres'], 'required'],
            [['Status'], 'integer'],
            [['Ci'], 'string', 'max' => 15],
            [['ApellidoPaterno', 'ApellidoMaterno', 'Nombres', 'Email'], 'string', 'max' => 45],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Ci' => 'Cédula de Identidad',
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
