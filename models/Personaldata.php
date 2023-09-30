<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personaldata".
 *
 * @property string $correo
 * @property string $nombres
 * @property string $apellidos
 * @property string $institucion
 * @property string $nivel
 *
 * @property User[] $users
 */
class Personaldata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personaldata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['correo', 'nombres', 'apellidos', 'institucion', 'nivel'], 'required'],
            [['correo'], 'string', 'max' => 300],
            [['nombres', 'apellidos', 'institucion', 'nivel'], 'string', 'max' => 45],
            [['correo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'correo' => 'Correo',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'institucion' => 'Institucion',
            'nivel' => 'Nivel',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['personaldata_correo' => 'correo']);
    }
}
