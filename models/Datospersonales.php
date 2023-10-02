<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datospersonales".
 *
 * @property int $id
 * @property string $Ci
 * @property string $Apellidos
 * @property string $Nombres
 * @property string|null $FechaNacimiento
 * @property string $Email
 * @property string $Genero
 * @property string|null $Institucion
 * @property string|null $Nivel
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
            [['Ci', 'Apellidos', 'Nombres', 'Email', 'Genero'], 'required'],
            [['FechaNacimiento'], 'safe'],
            [['Genero'], 'string'],
            [['Ci'], 'string', 'max' => 15],
            [['Apellidos'], 'string', 'max' => 40],
            [['Nombres', 'Email', 'Institucion', 'Nivel'], 'string', 'max' => 45],
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
            'Apellidos' => 'Apellidos',
            'Nombres' => 'Nombres',
            'FechaNacimiento' => 'Fecha Nacimiento',
            'Email' => 'Email',
            'Genero' => 'Genero',
            'Institucion' => 'Institucion',
            'Nivel' => 'Nivel',
        ];
    }
}
