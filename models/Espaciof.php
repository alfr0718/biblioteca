<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "espaciof".
 *
 * @property int $idespaciof
 * @property string $nombref
 * @property string $estadof
 *
 * @property Prestamo[] $prestamos
 */
class Espaciof extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'espaciof';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombref', 'estadof'], 'required'],
            [['nombref'], 'string', 'max' => 45],
            [['estadof'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idespaciof' => 'Idespaciof',
            'nombref' => 'Nombref',
            'estadof' => 'Estadof',
        ];
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::class, ['espacio_fisico_idespacio_fisico' => 'idespaciof']);
    }
}
