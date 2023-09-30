<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "computador".
 *
 * @property int $id_pc
 * @property string $pc_nombre
 * @property string $pc_estado
 *
 * @property Prestamo[] $prestamos
 */
class Computador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'computador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pc_nombre', 'pc_estado'], 'required'],
            [['pc_nombre', 'pc_estado'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pc' => 'Id Pc',
            'pc_nombre' => 'Pc Nombre',
            'pc_estado' => 'Pc Estado',
        ];
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::class, ['pc_idpc' => 'id_pc']);
    }
}
